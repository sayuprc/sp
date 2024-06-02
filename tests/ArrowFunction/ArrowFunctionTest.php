<?php

declare(strict_types=1);

namespace Tests\ArrowFunction;

use Tests\TestCase;

class ArrowFunctionTest extends TestCase
{
    public function testReturnOne(): void
    {
        $code = <<<'CODE'
        <?php
        $func = fn () => 1;
        echo $func();
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testReturnArg(): void
    {
        $code = <<<'CODE'
        <?php
        $func = fn ($arg) => $arg;
        echo $func(2);
        CODE;

        $this->expectOutputStringWithCode('2', $code);
    }

    public function testDefaultValue(): void
    {
        $code = <<<'CODE'
        <?php
        $func = fn ($arg = 'hoge') => $arg;
        echo $func();
        CODE;

        $this->expectOutputStringWithCode('hoge', $code);
    }
}
