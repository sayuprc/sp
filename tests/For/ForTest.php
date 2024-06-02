<?php

declare(strict_types=1);

namespace Tests\For;

use Exception;
use Tests\TestCase;

class ForTest extends TestCase
{
    public function testFor(): void
    {
        $this->expectedOutputString('0123456789')
            ->runFile(__DIR__ . '/data/for-normal.php');
    }

    public function testForWithBreak(): void
    {
        $this->expectedOutputString('01')
            ->runFile(__DIR__ . '/data/for-with-break.php');
    }

    public function testBreakInNestedFor(): void
    {
        $this->expectedOutputString('0012')
            ->runFile(__DIR__ . '/data/for-break-in-nested-for.php');
    }

    public function testInvalidBreakNum(): void
    {
        $this->expectedException(Exception::class)
            ->expectedExceptionMessage('cannot break 2 levels')
            ->runFile(__DIR__ . '/data/for-invalid-break-num.php');
    }

    public function testForWithContinue(): void
    {
        $this->expectedOutputString('013456789')
            ->runFile(__DIR__ . '/data/for-with-continue.php');
    }
}
