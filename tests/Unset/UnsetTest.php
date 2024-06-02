<?php

declare(strict_types=1);

namespace Tests\Unset;

use Tests\TestCase;

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

        $this->expectedOutputString('fuga')
            ->runCode($code);
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

        $this->expectedOutputString('')
            ->runCode($code);
    }
}
