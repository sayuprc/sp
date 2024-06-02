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
}
