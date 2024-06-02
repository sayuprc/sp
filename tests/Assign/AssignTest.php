<?php

declare(strict_types=1);

namespace Tests\Assign;

use Exception;
use Tests\TestCase;

class AssignTest extends TestCase
{
    public function testAssign(): void
    {
        $this->expectedOutputString('a')
            ->runFile(__DIR__ . '/data/assign-normal.php');
    }

    public function testNotAssign(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/assign-not-assign.php');
    }

    public function testMultipleAssign(): void
    {
        $this->expectedOutputString('101010')
            ->runFile(__DIR__ . '/data/assign-multiple-assign.php');
    }

    public function testReassignThis(): void
    {
        $this->expectedException(Exception::class)
            ->expectedExceptionMessage('cannot re-assign $this')
            ->runFile(__DIR__ . '/data/assign-reassign-this.php');
    }
}
