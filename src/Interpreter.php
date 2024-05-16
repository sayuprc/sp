<?php

declare(strict_types=1);

namespace StrictPhp;

use Error;
use Exception;
use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\ArrowFunction;
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
use PhpParser\Node\Expr\Empty_;
use PhpParser\Node\Expr\Exit_;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Include_;
use PhpParser\Node\Expr\Isset_;
use PhpParser\Node\Expr\Match_;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Param;
use PhpParser\Node\Scalar\Float_;
use PhpParser\Node\Scalar\Int_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt;
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
use PhpParser\Node\Stmt\Unset_;
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
     * @var array<string, array{params: array<int, Param>, stmts: array<int, Stmt>}>
     */
    private array $functions;

    /**
     * @var int<0, max>
     */
    private int $currentNest;

    /**
     * @var array<non-empty-string>
     */
    private array $includes;

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
        $this->includes = [];
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
     * @param mixed $node
     *
     * @return mixed
     */
    public function evaluate($node)
    {
        switch (get_class($node)) {
            case Echo_::class:
                $results = [];
                foreach ($node->exprs as $expr) {
                    $results[] = $this->evaluate($expr);
                }
                echo implode('', $results);
                return null;
            case String_::class:
            case Int_::class:
            case Float_::class:
                return $node->value;
            case Array_::class:
                $array = [];
                foreach ($node->items as $item) {
                    $value = $this->evaluate($item->value);
                    if (is_null($item->key)) {
                        $array[] = $value;
                    } else {
                        $array[$this->evaluate($item->key)] = $value;
                    }
                }
                return $array;
            case Concat::class:
                return $this->evaluate($node->left) . $this->evaluate($node->right);
            case Smaller::class:
                return $this->evaluate($node->left) < $this->evaluate($node->right);
            case SmallerOrEqual::class:
                return $this->evaluate($node->left) <= $this->evaluate($node->right);
            case Greater::class:
                return $this->evaluate($node->left) > $this->evaluate($node->right);
            case GreaterOrEqual::class:
                return $this->evaluate($node->left) >= $this->evaluate($node->right);
            case Spaceship::class:
                return $this->evaluate($node->left) <=> $this->evaluate($node->right);
            case Equal::class:
                return $this->evaluate($node->left) == $this->evaluate($node->right);
            case NotEqual::class:
                return $this->evaluate($node->left) != $this->evaluate($node->right);
            case Identical::class:
                return $this->evaluate($node->left) === $this->evaluate($node->right);
            case NotIdentical::class:
                return $this->evaluate($node->left) !== $this->evaluate($node->right);
            case Plus::class:
                return $this->evaluate($node->left) + $this->evaluate($node->right);
            case Minus::class:
                return $this->evaluate($node->left) - $this->evaluate($node->right);
            case Mul::class:
                return $this->evaluate($node->left) * $this->evaluate($node->right);
            case Div::class:
                return $this->evaluate($node->left) / $this->evaluate($node->right);
            case Mod::class:
                return $this->evaluate($node->left) % $this->evaluate($node->right);
            case Pow::class:
                return $this->evaluate($node->left) ** $this->evaluate($node->right);
            case BooleanAnd::class:
                return $this->evaluate($node->left) && $this->evaluate($node->right);
            case BooleanOr::class:
                return $this->evaluate($node->left) || $this->evaluate($node->right);
            case LogicalAnd::class:
                return $this->evaluate($node->left) and $this->evaluate($node->right);
            case LogicalOr::class:
                return $this->evaluate($node->left) or $this->evaluate($node->right);
            case LogicalXor::class:
                return $this->evaluate($node->left) xor $this->evaluate($node->right);
            case BitwiseAnd::class:
                return $this->evaluate($node->left) & $this->evaluate($node->right);
            case BitwiseOr::class:
                return $this->evaluate($node->left) | $this->evaluate($node->right);
            case BitwiseXor::class:
                return $this->evaluate($node->left) ^ $this->evaluate($node->right);
            case Coalesce::class:
                return $this->evaluate($node->left) ?? $this->evaluate($node->right);
            case ShiftLeft::class:
                return $this->evaluate($node->left) << $this->evaluate($node->right);
            case ShiftRight::class:
                return $this->evaluate($node->left) >> $this->evaluate($node->right);
            case If_::class:
                $ifResult = $this->evaluate($node->cond);

                if ($ifResult) {
                    foreach ($node->stmts as $stmt) {
                        $result = $this->evaluate($stmt);
                        if ($result instanceof ContinueObject || $result instanceof BreakObject) {
                            return $result;
                        }
                    }
                }

                $elseIfResult = false;

                if (! $ifResult && 0 < count($node->elseifs)) {
                    foreach ($node->elseifs as $elseif) {
                        $elseIfResult = $this->evaluate($elseif);
                    }
                }

                if (! $ifResult && ! $elseIfResult && $node->else instanceof Else_) {
                    $this->evaluate($node->else);
                }
                break;
            case ElseIf_::class:
                $elseIfResult = $this->evaluate($node->cond);
                if ($elseIfResult) {
                    foreach ($node->stmts as $stmt) {
                        $this->evaluate($stmt);
                    }
                }
                return $elseIfResult;
            case Else_::class:
                foreach ($node->stmts as $stmt) {
                    $this->evaluate($stmt);
                }
                break;
            case Nop::class:
                // nothing todo
                break;
            case Expression::class:
                return $this->evaluate($node->expr);
            case Assign::class:
                $var = $node->var;
                if ($var instanceof Variable) {
                    $name = $var->name;
                    if ($name === 'this') {
                        throw new Exception('cannot re-assign $this');
                    }
                    $value = $this->evaluate($node->expr);
                    $this->scope->set($name, $value);
                    return $value;
                }
                break;
            case Variable::class:
                $name = $node->name;
                return $this->scope->get($name);
            case ConstFetch::class:
                return match ($node->name->name) {
                    'true' => true,
                    'false' => false,
                    'null' => null,
                    default => throw new Exception('unknown const'),
                };
            case ArrayDimFetch::class:
                $array = $this->evaluate($node->var);
                $key = $this->evaluate($node->dim);
                if (array_key_exists($key, $array)) {
                    return $array[$key];
                }
                throw new Exception("unknown index: {$key} in array");
            case Function_::class:
                $name = $node->name->toString();
                if (function_exists($name)) {
                    throw new Error("Cannot redeclare {$name}()");
                }
                $this->functions[$name] = [
                    'params' => $node->params,
                    'stmts' => $node->stmts,
                ];
                break;
            case FuncCall::class:
                if ($node->name instanceof Variable) {
                    $function = $this->evaluate($node->name);
                    $args = [];
                    foreach ($node->args as $arg) {
                        $args[] = $this->evaluate($arg);
                    }
                    $functionScope = clone $this->scope;
                    foreach ($function['params'] as $key => $param) {
                        $arg = match (true) {
                            isset($args[$key]) => $args[$key],
                            ! isset($args[$key]) && ! is_null($param->default) => $this->evaluate($param->default),
                            default => throw new Error("Uncaught ArgumentCountError: Too few arguments to function {$node->name->name}()"),
                        };
                        $functionScope->set($param->var->name, $arg);
                    }
                    $beforeScope = $this->scope;
                    $this->scope = $functionScope;
                    $result = $this->evaluate($function['expr']);
                    $this->scope = $beforeScope;
                    return $result;
                }
                $name = $node->name->toString();
                if (function_exists($name)) {
                    $args = [];
                    foreach ($node->args as $arg) {
                        $args[] = $this->evaluate($arg);
                    }
                    return $name(...$args);
                } elseif (array_key_exists($name, $this->functions)) {
                    $function = $this->functions[$name];
                    $args = [];
                    foreach ($node->args as $arg) {
                        $args[] = $this->evaluate($arg);
                    }
                    $functionScope = new Scope();
                    foreach ($function['params'] as $key => $param) {
                        $arg = match (true) {
                            isset($args[$key]) => $args[$key],
                            ! isset($args[$key]) && ! is_null($param->default) => $this->evaluate($param->default),
                            default => throw new Error("Uncaught ArgumentCountError: Too few arguments to function {$name}()"),
                        };
                        $functionScope->set($param->var->name, $arg);
                    }
                    $beforeScope = $this->scope;
                    $this->scope = $functionScope;
                    foreach ($function['stmts'] as $stmt) {
                        $result = $this->evaluate($stmt);
                        if ($stmt instanceof Return_) {
                            return $result;
                        }
                    }
                    $this->scope = $beforeScope;
                }
                break;
            case Arg::class:
                return $this->evaluate($node->value);
            case Return_::class:
                return $this->evaluate($node->expr);
            case Foreach_::class:
                $this->currentNest += 1;
                $array = $this->evaluate($node->expr);
                foreach ($array as $key => $item) {
                    if ($node->valueVar instanceof Variable) {
                        $this->scope->set($node->valueVar->name, $item);
                    }
                    if ($node->keyVar instanceof Variable) {
                        $this->scope->set($node->keyVar->name, $key);
                    }
                    foreach ($node->stmts as $stmt) {
                        $result = $this->evaluate($stmt);

                        if ($result instanceof BreakObject) {
                            if (1 < $result->num()) {
                                $result->decrement();
                                return $result;
                            }
                            break 2;
                        }

                        if ($result instanceof ContinueObject) {
                            break;
                        }
                    }
                }
                $this->currentNest = 0;
                break;
            case While_::class:
                $this->currentNest += 1;
                while ($this->evaluate($node->cond)) {
                    foreach ($node->stmts as $stmt) {
                        $result = $this->evaluate($stmt);

                        if ($result instanceof BreakObject) {
                            if (1 < $result->num()) {
                                $result->decrement();
                                return $result;
                            }
                            break 2;
                        }

                        if ($result instanceof ContinueObject) {
                            break;
                        }
                    }
                }
                $this->currentNest = 0;
                break;
            case For_::class:
                $this->currentNest += 1;
                foreach ($node->init as $init) {
                    $this->evaluate($init);
                }
                while (true) {
                    foreach ($node->cond as $cond) {
                        if (! $this->evaluate($cond)) {
                            break 2;
                        }
                    }
                    foreach ($node->stmts as $stmt) {
                        $result = $this->evaluate($stmt);
                        if ($result instanceof BreakObject) {
                            if (1 < $result->num()) {
                                $result->decrement();
                                return $result;
                            }
                            break 2;
                        }

                        if ($result instanceof ContinueObject) {
                            break;
                        }
                    }
                    foreach ($node->loop as $loop) {
                        $this->evaluate($loop);
                    }
                }
                $this->currentNest = 0;
                break;
            case Do_::class:
                $this->currentNest += 1;
                do {
                    foreach ($node->stmts as $stmt) {
                        $result = $this->evaluate($stmt);

                        if ($result instanceof BreakObject) {
                            if (1 < $result->num()) {
                                $result->decrement();
                                return $result;
                            }
                            break 2;
                        }

                        if ($result instanceof ContinueObject) {
                            break;
                        }
                    }
                } while ($this->evaluate($node->cond));
                $this->currentNest = 0;
                break;
            case Continue_::class:
                return new ContinueObject();
            case Break_::class:
                $breakNum = is_null($node->num) ? 1 : $this->evaluate($node->num);
                if ($this->currentNest < $breakNum) {
                    throw new Exception("cannot break {$breakNum} levels");
                }
                return new BreakObject($breakNum);
            case Switch_::class:
                $this->currentNest += 1;
                $cond = $this->evaluate($node->cond);
                $isMatched = false;
                foreach ($node->cases as $case) {
                    if (is_null($case->cond)) {
                        foreach ($case->stmts as $stmt) {
                            $this->evaluate($stmt);
                        }
                        break;
                    } elseif ($cond == $this->evaluate($case->cond) || $isMatched) {
                        $isMatched = true;

                        foreach ($case->stmts as $stmt) {
                            $result = $this->evaluate($stmt);

                            if ($result instanceof BreakObject) {
                                if (1 < $result->num()) {
                                    $result->decrement();
                                    return $result;
                                }
                                break 2;
                            }
                        }
                    }
                }
                $this->currentNest = 0;
                break;
            case Match_::class:
                $cond = $this->evaluate($node->cond);
                foreach ($node->arms as $arm) {
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
            case Include_::class:
                $file = $this->evaluate($node->expr);
                $isRequired = match ($node->type) {
                    Include_::TYPE_REQUIRE, Include_::TYPE_REQUIRE_ONCE => true,
                    default => false,
                };
                $isOnce = match ($node->type) {
                    Include_::TYPE_INCLUDE_ONCE, Include_::TYPE_REQUIRE_ONCE => true,
                    default => false,
                };
                if (! file_exists($file)) {
                    if ($isRequired) {
                        throw new Error("Failed opening required '{$file}'");
                    }
                    break;
                }
                if (! $isOnce || ! in_array($file, $this->includes, true)) {
                    $code = file_get_contents($file);
                    $this->run($code);
                }
                if ($isOnce) {
                    $this->includes[] = $file;
                }
                break;
            case Isset_::class:
                foreach ($node->vars as $var) {
                    if (is_null($this->evaluate($var))) {
                        return false;
                    }
                }
                return true;
            case Empty_::class:
                return empty($this->evaluate($node->expr));
            case Unset_::class:
                foreach ($node->vars as $var) {
                    if ($var instanceof Variable) {
                        $this->scope->remove($var->name);
                    }
                }
                break;
            case Exit_::class:
                $status = is_null($node->expr) ? 0 : $this->evaluate($node->expr);
                exit($status);
            case ArrowFunction::class:
                return [
                    'params' => $node->params,
                    'expr' => $node->expr,
                ];
            default:
                $token = $node instanceof Node
                    ? $node->getType()
                    : 'unknown';
                throw new Exception("Unknown token: {$token}");
        }
    }
}
