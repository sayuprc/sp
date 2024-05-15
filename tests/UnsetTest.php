<?php

declare(strict_types=1);

namespace Tests;

class UnsetTest extends TestCase
{
    public function test(): void
    {
        $code = <<<'CODE'
        <?php
        $foo = 'hoge';
        $bar = 'fuga';
        unset($foo);
        echo $foo, $bar;
        CODE;

        $this->expectOutputStringWithCode('fuga', $code);
    }

    public function testUnsetMulti(): void
    {
        $code = <<<'CODE'
        <?php
        $foo = 'hoge';
        $bar = 'fuga';
        unset($foo, $bar);
        echo $foo, $bar;
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }
}
