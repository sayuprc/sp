<?php

declare(strict_types=1);

namespace Tests;

use Error;

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

        $this->expectOutputStringWithCode('2', $code);
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

        $this->expectOutputStringWithCode('', $code);
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

        $this->expectOutputStringWithCode('2', $code);
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

        $this->expectOutputStringWithCode('', $code);
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

        $this->expectOutputStringWithCode('1', $code);
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

        $this->expectException(Error::class);
        $this->expectExceptionMessage('Uncaught ArgumentCountError: Too few arguments to function func()');
        $this->interpreter->run($code);
    }
}
