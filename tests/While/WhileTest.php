<?php

declare(strict_types=1);

namespace Tests\While;

use Exception;
use Tests\TestCase;

class WhileTest extends TestCase
{
    public function testWhile(): void
    {
        $this->expectedOutputString('0123456789')
            ->runFile(__DIR__ . '/data/while-normal.php');
    }

    public function testWhileBreak(): void
    {
        $this->expectedOutputString('01')
            ->runFile(__DIR__ . '/data/while-break.php');
    }

    public function testBreakInNestedWhile(): void
    {
        $this->expectedOutputString('0012')
            ->runFile(__DIR__ . '/data/while-break-in-nested-while.php');
    }

    public function testInvalidBreakNum(): void
    {
        $this->expectedException(Exception::class)
            ->expectedExceptionMessage('cannot break 2 levels')
            ->runFile(__DIR__ . '/data/while-invalid-break-num.php');
    }

    public function testWhileContinue(): void
    {
        $this->expectedOutputString('013456789')
            ->runFile(__DIR__ . '/data/while-continue.php');
    }
}
