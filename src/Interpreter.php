<?php

declare(strict_types=1);

namespace StrictPhp;

use Error;
use Exception;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\BinaryOp\BitwiseAnd;
use PhpParser\Node\Expr\BinaryOp\BitwiseOr;
use PhpParser\Node\Expr\BinaryOp\BitwiseXor;
use PhpParser\Node\Expr\BinaryOp\BooleanAnd;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use PhpParser\Node\Expr\BinaryOp\Coalesce;
use PhpParser\Node\Expr\BinaryOp\Concat;
use PhpParser\Node\Expr\BinaryOp\Div;
use PhpParser\Node\Expr\BinaryOp\Equal;
use PhpParser\Node\Expr\BinaryOp\Greater;
use PhpParser\Node\Expr\BinaryOp\GreaterOrEqual;
use PhpParser\Node\Expr\BinaryOp\Identical;
use PhpParser\Node\Expr\BinaryOp\LogicalAnd;
use PhpParser\Node\Expr\BinaryOp\LogicalOr;
use PhpParser\Node\Expr\BinaryOp\LogicalXor;
use PhpParser\Node\Expr\BinaryOp\Minus;
use PhpParser\Node\Expr\BinaryOp\Mod;
use PhpParser\Node\Expr\BinaryOp\Mul;
use PhpParser\Node\Expr\BinaryOp\NotEqual;
use PhpParser\Node\Expr\BinaryOp\NotIdentical;
use PhpParser\Node\Expr\BinaryOp\Plus;
use PhpParser\Node\Expr\BinaryOp\Pow;
use PhpParser\Node\Expr\BinaryOp\ShiftLeft;
use PhpParser\Node\Expr\BinaryOp\ShiftRight;
use PhpParser\Node\Expr\BinaryOp\Smaller;
use PhpParser\Node\Expr\BinaryOp\SmallerOrEqual;
use PhpParser\Node\Expr\BinaryOp\Spaceship;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Match_;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\Float_;
use PhpParser\Node\Scalar\Int_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Continue_;
use PhpParser\Node\Stmt\Do_;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\Else_;
use PhpParser\Node\Stmt\ElseIf_;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\For_;
use PhpParser\Node\Stmt\Foreach_;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Nop;
use PhpParser\Node\Stmt\Return_;
use PhpParser\Node\Stmt\Switch_;
use PhpParser\Node\Stmt\While_;
use PhpParser\NodeDumper;
use PhpParser\Parser;

class Interpreter
{
    /**
     * @var Scope
     */
    private Scope $scope;

    /**
     * @var array
     */
    private array $functions;

    /**
     * @var int<0, max>
     */
    private int $currentNest;

    /**
     * @param Parser $parser
     * @param bool   $isDebug
     */
    public function __construct(
        private readonly Parser $parser,
        private readonly bool $isDebug = false
    ) {
        $this->scope = new Scope();
        $this->functions = [];
        $this->currentNest = 0;
    }

    /**
     * @param string $code
     *
     * @return void
     */
    public function run(string $code)
    {
        $ast = $this->parser->parse($code);

        if ($this->isDebug) {
            $dumper = new NodeDumper();
            echo $dumper->dump($ast), PHP_EOL;
        }

        foreach ($ast as $stmt) {
            $this->evaluate($stmt);
        }
    }

    /**
     * @param mixed $stmt
     *
     * @return mixed
     */
    public function evaluate($stmt)
    {
        switch (get_class($stmt)) {
            case Echo_::class:
                $ret = [];
                foreach ($stmt->exprs as $expr) {
                    $ret[] = $this->evaluate($expr);
                }
                echo implode('', $ret);
                return null;
            case String_::class:
            case Int_::class:
            case Float_::class:
                return $stmt->value;
            case Array_::class:
                $ret = [];
                foreach ($stmt->items as $item) {
                    $value = $this->evaluate($item->value);
                    if (is_null($item->key)) {
                        $ret[] = $value;
                    } else {
                        $ret[$this->evaluate($item->key)] = $value;
                    }
                }
                return $ret;
            case Concat::class:
                return $this->evaluate($stmt->left) . $this->evaluate($stmt->right);
            case Smaller::class:
                return $this->evaluate($stmt->left) < $this->evaluate($stmt->right);
            case SmallerOrEqual::class:
                return $this->evaluate($stmt->left) <= $this->evaluate($stmt->right);
            case Greater::class:
                return $this->evaluate($stmt->left) > $this->evaluate($stmt->right);
            case GreaterOrEqual::class:
                return $this->evaluate($stmt->left) >= $this->evaluate($stmt->right);
            case Spaceship::class:
                return $this->evaluate($stmt->left) <=> $this->evaluate($stmt->right);
            case Equal::class:
                return $this->evaluate($stmt->left) == $this->evaluate($stmt->right);
            case NotEqual::class:
                return $this->evaluate($stmt->left) != $this->evaluate($stmt->right);
            case Identical::class:
                return $this->evaluate($stmt->left) === $this->evaluate($stmt->right);
            case NotIdentical::class:
                return $this->evaluate($stmt->left) !== $this->evaluate($stmt->right);
            case Plus::class:
                return $this->evaluate($stmt->left) + $this->evaluate($stmt->right);
            case Minus::class:
                return $this->evaluate($stmt->left) - $this->evaluate($stmt->right);
            case Mul::class:
                return $this->evaluate($stmt->left) * $this->evaluate($stmt->right);
            case Div::class:
                return $this->evaluate($stmt->left) / $this->evaluate($stmt->right);
            case Mod::class:
                return $this->evaluate($stmt->left) % $this->evaluate($stmt->right);
            case Pow::class:
                return $this->evaluate($stmt->left) ** $this->evaluate($stmt->right);
            case BooleanAnd::class:
                return $this->evaluate($stmt->left) && $this->evaluate($stmt->right);
            case BooleanOr::class:
                return $this->evaluate($stmt->left) || $this->evaluate($stmt->right);
            case LogicalAnd::class:
                return $this->evaluate($stmt->left) and $this->evaluate($stmt->right);
            case LogicalOr::class:
                return $this->evaluate($stmt->left) or $this->evaluate($stmt->right);
            case LogicalXor::class:
                return $this->evaluate($stmt->left) xor $this->evaluate($stmt->right);
            case BitwiseAnd::class:
                return $this->evaluate($stmt->left) & $this->evaluate($stmt->right);
            case BitwiseOr::class:
                return $this->evaluate($stmt->left) | $this->evaluate($stmt->right);
            case BitwiseXor::class:
                return $this->evaluate($stmt->left) ^ $this->evaluate($stmt->right);
            case Coalesce::class:
                return $this->evaluate($stmt->left) ?? $this->evaluate($stmt->right);
            case ShiftLeft::class:
                return $this->evaluate($stmt->left) << $this->evaluate($stmt->right);
            case ShiftRight::class:
                return $this->evaluate($stmt->left) >> $this->evaluate($stmt->right);
            case If_::class:
                $ifResult = $this->evaluate($stmt->cond);

                if ($ifResult) {
                    foreach ($stmt->stmts as $node) {
                        $ret = $this->evaluate($node);
                        if ($ret instanceof ContinueObject || $ret instanceof BreakObject) {
                            return $ret;
                        }
                    }
                }

                $elseIfResult = false;

                if (! $ifResult && 0 < count($stmt->elseifs)) {
                    foreach ($stmt->elseifs as $elseif) {
                        $elseIfResult = $this->evaluate($elseif);
                    }
                }

                if (! $ifResult && ! $elseIfResult && $stmt->else instanceof Else_) {
                    $this->evaluate($stmt->else);
                }
                break;
            case ElseIf_::class:
                $elseIfResult = $this->evaluate($stmt->cond);
                if ($elseIfResult) {
                    foreach ($stmt->stmts as $node) {
                        $this->evaluate($node);
                    }
                }
                return $elseIfResult;
            case Else_::class:
                foreach ($stmt->stmts as $node) {
                    $this->evaluate($node);
                }
                break;
            case Nop::class:
                // nothing todo
                break;
            case Expression::class:
                return $this->evaluate($stmt->expr);
            case Assign::class:
                $var = $stmt->var;
                if ($var instanceof Variable) {
                    $name = $var->name;
                    if ($name === 'this') {
                        throw new Exception('cannot re-assign $this');
                    }
                    $ret = $this->evaluate($stmt->expr);
                    $this->scope->set($name, $ret);
                    return $ret;
                }
                break;
            case Variable::class:
                $name = $stmt->name;
                return $this->scope->get($name);
            case ConstFetch::class:
                return match ($stmt->name->name) {
                    'true' => true,
                    'false' => false,
                    'null' => null,
                    default => throw new Exception('unknown const'),
                };
            case ArrayDimFetch::class:
                $array = $this->evaluate($stmt->var);
                $key = $this->evaluate($stmt->dim);
                if (array_key_exists($key, $array)) {
                    return $array[$key];
                }
                throw new Exception("unknown index: {$key} in array");
            case Function_::class:
                $name = $stmt->name->toString();
                $this->functions[$name] = [
                    'params' => $stmt->params,
                    'stmts' => $stmt->stmts,
                ];
                break;
            case FuncCall::class:
                $name = $stmt->name->toString();
                if (array_key_exists($name, $this->functions)) {
                    $function = $this->functions[$name];
                    $args = [];
                    foreach ($stmt->args as $arg) {
                        $args[] = $this->evaluate($arg);
                    }
                    $functionScope = new Scope();
                    foreach ($function['params'] as $key => $param) {
                        $functionScope->set($param->var->name, $args[$key]);
                    }
                    $beforeScope = $this->scope;
                    $this->scope = $functionScope;
                    foreach ($function['stmts'] as $stmt) {
                        $ret = $this->evaluate($stmt);
                        if ($stmt instanceof Return_) {
                            return $ret;
                        }
                    }
                    $this->scope = $beforeScope;
                }
                break;
            case Arg::class:
                return $this->evaluate($stmt->value);
            case Return_::class:
                return $this->evaluate($stmt->expr);
            case Foreach_::class:
                $this->currentNest += 1;
                $array = $this->evaluate($stmt->expr);
                foreach ($array as $key => $item) {
                    if ($stmt->valueVar instanceof Variable) {
                        $this->scope->set($stmt->valueVar->name, $item);
                    }
                    if ($stmt->keyVar instanceof Variable) {
                        $this->scope->set($stmt->keyVar->name, $key);
                    }
                    foreach ($stmt->stmts as $expr) {
                        $ret = $this->evaluate($expr);

                        if ($ret instanceof BreakObject) {
                            if (1 < $ret->num()) {
                                $ret->decrement();
                                return $ret;
                            }
                            break 2;
                        }

                        if ($ret instanceof ContinueObject) {
                            break;
                        }
                    }
                }
                $this->currentNest = 0;
                break;
            case While_::class:
                $this->currentNest += 1;
                while ($this->evaluate($stmt->cond)) {
                    foreach ($stmt->stmts as $node) {
                        $ret = $this->evaluate($node);

                        if ($ret instanceof BreakObject) {
                            if (1 < $ret->num()) {
                                $ret->decrement();
                                return $ret;
                            }
                            break 2;
                        }

                        if ($ret instanceof ContinueObject) {
                            break;
                        }
                    }
                }
                $this->currentNest = 0;
                break;
            case For_::class:
                $this->currentNest += 1;
                foreach ($stmt->init as $init) {
                    $this->evaluate($init);
                }
                while (true) {
                    foreach ($stmt->cond as $cond) {
                        if (! $this->evaluate($cond)) {
                            break 2;
                        }
                    }
                    foreach ($stmt->stmts as $node) {
                        $ret = $this->evaluate($node);
                        if ($ret instanceof BreakObject) {
                            if (1 < $ret->num()) {
                                $ret->decrement();
                                return $ret;
                            }
                            break 2;
                        }

                        if ($ret instanceof ContinueObject) {
                            break;
                        }
                    }
                    foreach ($stmt->loop as $loop) {
                        $this->evaluate($loop);
                    }
                }
                $this->currentNest = 0;
                break;
            case Do_::class:
                $this->currentNest += 1;
                do {
                    foreach ($stmt->stmts as $node) {
                        $ret = $this->evaluate($node);

                        if ($ret instanceof BreakObject) {
                            if (1 < $ret->num()) {
                                $ret->decrement();
                                return $ret;
                            }
                            break 2;
                        }

                        if ($ret instanceof ContinueObject) {
                            break;
                        }
                    }
                } while ($this->evaluate($stmt->cond));
                $this->currentNest = 0;
                break;
            case Continue_::class:
                return new ContinueObject();
            case Break_::class:
                $breakNum = is_null($stmt->num) ? 1 : $this->evaluate($stmt->num);
                if ($this->currentNest < $breakNum) {
                    throw new Exception("cannot break {$breakNum} levels");
                }
                return new BreakObject($breakNum);
            case Switch_::class:
                $this->currentNest += 1;
                $cond = $this->evaluate($stmt->cond);
                $isMatched = false;
                foreach ($stmt->cases as $case) {
                    if (is_null($case->cond)) {
                        foreach ($case->stmts as $node) {
                            $this->evaluate($node);
                        }
                        break;
                    } elseif ($cond == $this->evaluate($case->cond) || $isMatched) {
                        $isMatched = true;

                        foreach ($case->stmts as $node) {
                            $ret = $this->evaluate($node);

                            if ($ret instanceof BreakObject) {
                                if (1 < $ret->num()) {
                                    $ret->decrement();
                                    return $ret;
                                }
                                break 2;
                            }
                        }
                    }
                }
                $this->currentNest = 0;
                break;
            case Match_::class:
                $cond = $this->evaluate($stmt->cond);
                foreach ($stmt->arms as $arm) {
                    if (is_null($arm->conds)) {
                        return $this->evaluate($arm->body);
                    }
                    foreach ($arm->conds as $armCond) {
                        if ($cond === $this->evaluate($armCond)) {
                            return $this->evaluate($arm->body);
                        }
                    }
                }
                throw new Error("Unhandled match case {$cond}");
        }
    }
}
