<?php

declare(strict_types=1);

namespace Tests\Function;

use Error;
use Tests\TestCase;

class FunctionTest extends TestCase
{
    public function testFunction(): void
    {
        $this->expectedOutputString('2')
            ->runFile(__DIR__ . '/data/function-normal.php');
    }

    public function testFunctionNotReturn(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/function-not-return.php');
    }

    public function testFunctionWithArg(): void
    {
        $this->expectedOutputString('2')
            ->runFile(__DIR__ . '/data/function-with-arg.php');
    }

    public function testCallVariableOutsideFunctionScope(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/function-call-variable-outside-function-scope.php');
    }

    public function testWithDefaultValue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/function-with-default-value.php');
    }

    public function testInvalidArgument(): void
    {
        $this->expectedException(Error::class)
            ->expectedExceptionMessage('Uncaught ArgumentCountError: Too few arguments to function func()')
            ->runFile(__DIR__ . '/data/function-invalid-argument.php');
    }

    public function testCallBuiltInFunction(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/function-call-built-in-function.php');
    }

    public function testRedeclareBuiltInFunction(): void
    {
        $this->expectedException(Error::class)
            ->expectedExceptionMessage('Cannot redeclare in_array()')
            ->runFile(__DIR__ . '/data/function-redeclare-built-in-function.php');
    }

    public function testCallOtherFunction(): void
    {
        $this->expectedOutputString('func_b/func_a')
            ->runFile(__DIR__ . '/data/function-call-other-function.php');
    }

    public function testCallVariableSameName(): void
    {
        $this->expectedOutputString('fugahoge')
            ->runFile(__DIR__ . '/data/function-call-vatiable-same-name.php');
    }
}
