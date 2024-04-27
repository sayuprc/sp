<?php

declare(strict_types=1);

namespace StrictPhp;

use PhpParser\Node\Expr\BinaryOp\Concat;
use PhpParser\Node\Scalar\Float_;
use PhpParser\Node\Scalar\Int_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Echo_;
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
        }
    }
}
