<?php

declare(strict_types=1);

namespace Tests\Assign;

use Exception;
use Tests\TestCase;

class AssignTest extends TestCase
{
    public function testAssign(): void
    {
        $code = <<<'CODE'
        <?php
        $var = 'a';
        echo $var;
        CODE;

        $this->expectedOutputString('a')
            ->runCode($code);
    }

    public function testNotAssign(): void
    {
        $code = <<<'CODE'
        <?php
        echo $var;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testMultipleAssign(): void
    {
        $code = <<<'CODE'
        <?php
        $foo = $bar = $baz = 10;
        echo $foo, $bar, $baz;
        CODE;

        $this->expectedOutputString('101010')
            ->runCode($code);
    }

    public function testAssignThis(): void
    {
        $code = <<<'CODE'
        <?php
        $this = 1;
        CODE;

        $this->expectedException(Exception::class)
            ->expectedExceptionMessage('cannot re-assign $this')
            ->runCode($code);
    }
}
