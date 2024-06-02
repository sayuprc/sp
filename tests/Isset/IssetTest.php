<?php

declare(strict_types=1);

namespace Tests\Isset;

use Tests\TestCase;

class IssetTest extends TestCase
{
    public function testSetString(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/isset-string.php');
    }

    public function testSetTruthyInt(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/isset-truthy-int.php');
    }

    public function testSetFalsyInt(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/isset-falsy-int.php');
    }

    public function testSetTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/isset-true.php');
    }

    public function testSetFalse(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/isset-false.php');
    }

    public function testSetNull(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/isset-null.php');
    }

    public function testUndefined(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/isset-undefined.php');
    }

    public function testAllSet(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/isset-all-set.php');
    }

    public function testNotAllSet(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/isset-not-all-set.php');
    }
}
