<?php

declare(strict_types=1);

namespace Tests\ArrowFunction;

use Tests\TestCase;

class ArrowFunctionTest extends TestCase
{
    public function testReturnOne(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/arrow-function-return-one.php');
    }

    public function testReturnArg(): void
    {
        $this->expectedOutputString('2')
            ->runFile(__DIR__ . '/data/arrow-function-return-arg.php');
    }

    public function testDefaultValue(): void
    {
        $this->expectedOutputString('hoge')
            ->runFile(__DIR__ . '/data/arrow-function-default-value.php');
    }

    public function testCallVariableOutsideScope(): void
    {
        $this->expectedOutputString('outside')
            ->runFile(__DIR__ . '/data/arrow-function-call-variable-outside-scope.php');
    }

    public function testCallOtherArrowFunction(): void
    {
        $this->expectedOutputString('arrow_func_b/arrow_func_a')
            ->runFile(__DIR__ . '/data/arrow-function-call-other-arrow-function.php');
    }

    public function testCallOtherFunction(): void
    {
        $this->expectedOutputString('func_b/func_a')
            ->runFile(__DIR__ . '/data/arrow-function-call-other-function.php');
    }
}
