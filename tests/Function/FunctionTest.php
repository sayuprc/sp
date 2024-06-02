<?php

declare(strict_types=1);

namespace Tests\Function;

use Error;
use Tests\TestCase;

class FunctionTest extends TestCase
{
    public function testFunction(): void
    {
        $code = <<<'CODE'
        <?php
        function func()
        {
            return 1 + 1;
        }

        echo func();
        CODE;

        $this->expectedOutputString('2')
            ->runCode($code);
    }

    public function testFunctionNotReturn(): void
    {
        $code = <<<'CODE'
        <?php
        function func()
        {
            $a = 1 + 1;
        }

        echo func();
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testFunctionWithArg(): void
    {
        $code = <<<'CODE'
        <?php
        function func($arg)
        {
            return $arg + 1;
        }

        echo func(1);
        CODE;

        $this->expectedOutputString('2')
            ->runCode($code);
    }

    public function testCallVariableWithoutFunctionScope(): void
    {
        $code = <<<'CODE'
        <?php
        function func()
        {
            return $arg;
        }

        $arg = 1;

        echo func();
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testWithDefaultValue(): void
    {
        $code = <<<'CODE'
        <?php
        function func($arg = 1)
        {
            return $arg;
        }

        echo func();
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testInvalidArgument(): void
    {
        $code = <<<'CODE'
        <?php
        function func($arg)
        {
            return $arg;
        }

        echo func();
        CODE;

        $this->expectedException(Error::class)
            ->expectedExceptionMessage('Uncaught ArgumentCountError: Too few arguments to function func()')
            ->runCode($code);
    }

    public function testCallBuiltInFunction(): void
    {
        $code = <<<'CODE'
        <?php
        echo in_array(1, [1, 2, 3], true);
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testDeclareBuiltInFunction(): void
    {
        $code = <<<'CODE'
        <?php
        function in_array()
        {
        }
        CODE;

        $this->expectedException(Error::class)
            ->expectedExceptionMessage('Cannot redeclare in_array()')
            ->runCode($code);
    }
}
