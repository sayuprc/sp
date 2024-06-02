<?php

declare(strict_types=1);

namespace Tests\DoWhile;

use Exception;
use Tests\TestCase;

class DoWhileTest extends TestCase
{
    public function testDoWhile(): void
    {
        $this->expectedOutputString('0')
            ->runFile(__DIR__ . '/data/do-while-normal.php');
    }

    public function testBreakInNestedDoWhile(): void
    {
        $this->expectedOutputString('0012')
            ->runFile(__DIR__ . '/data/do-while-break-in-nested-do-while.php');
    }

    public function testInvalidBreakNum(): void
    {
        $this->expectedException(Exception::class)
            ->expectedExceptionMessage('cannot break 2 levels')
            ->runFile(__DIR__ . '/data/do-while-invalid-break-num.php');
    }
}
