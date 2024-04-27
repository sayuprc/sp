<?php

declare(strict_types=1);

namespace StrictPhp;

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
            echo $dumper->dump($ast) ,PHP_EOL;
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
        // TODO implement
    }
}
