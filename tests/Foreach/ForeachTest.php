<?php

declare(strict_types=1);

namespace Tests\Foreach;

use Exception;
use Tests\TestCase;

class ForeachTest extends TestCase
{
    public function testForeach(): void
    {
        $this->expectedOutputString('abc')
            ->runFile(__DIR__ . '/data/foreach-normal.php');
    }

    public function testForeachWithKey(): void
    {
        $this->expectedOutputString('0=>a1=>b2=>c')
            ->runFile(__DIR__ . '/data/foreach-with-key.php');
    }

    public function testForeachWithBreak(): void
    {
        $this->expectedOutputString('a')
            ->runFile(__DIR__ . '/data/foreach-with-break.php');
    }

    public function testBreakInNestedForeach(): void
    {
        $this->expectedOutputString('112')
            ->runFile(__DIR__ . '/data/foreach-break-in-nested-foreach.php');
    }

    public function testInvalidBreakNum(): void
    {
        $this->expectedException(Exception::class)
            ->expectedExceptionMessage('cannot break 2 levels')
            ->runFile(__DIR__ . '/data/foreach-invalid-break-num.php');
    }

    public function testForeachWithContinue(): void
    {
        $this->expectedOutputString('ac')
            ->runFile(__DIR__ . '/data/foreach-with-continue.php');
    }
}
