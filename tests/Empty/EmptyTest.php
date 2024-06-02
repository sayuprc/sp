<?php

declare(strict_types=1);

namespace Tests\Empty;

use Tests\TestCase;

class EmptyTest extends TestCase
{
    public function testIntOne(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/empty-int-one.php');
    }

    public function testIntZero(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/empty-int-zero.php');
    }

    public function testEmptyString(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/empty-string.php');
    }

    public function testStringOne(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/empty-string-zero.php');
    }

    public function testStringZero(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/empty-string-zero.php');
    }

    public function testNull(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/empty-null.php');
    }

    public function testDefined(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/empty-defined.php');
    }

    public function testEmptyArray(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/empty-array.php');
    }

    public function testNotEmptyArray(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/empty-not-empty-array.php');
    }
}
