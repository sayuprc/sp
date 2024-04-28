<?php

declare(strict_types=1);

namespace StrictPhp;

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
use PhpParser\Node\Scalar\Float_;
use PhpParser\Node\Scalar\Int_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\Else_;
use PhpParser\Node\Stmt\ElseIf_;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Nop;
use PhpParser\NodeDumper;
use PhpParser\Parser;

class Interpreter
{
    /**
     * @param Parser $parser
     * @param bool   $isDebug
     */
    public function __construct(
        private readonly Parser $parser,
        private readonly bool $isDebug = false
    ) {
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
                        $this->evaluate($node);
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
        }
    }
}
