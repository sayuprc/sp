<?php

declare(strict_types=1);

namespace Tests\Array;

use Tests\TestCase;

class ArrayTest extends TestCase
{
    public function testArray(): void
    {
        $this->expectedOutputString('foobuz')
            ->runFile(__DIR__ . '/data/array-normal.php');
    }

    public function testArrayWithKey(): void
    {
        $this->expectedOutputString('hogepiyo')
            ->runFile(__DIR__ . '/data/array-with-key.php');
    }

    public function testNestedArray(): void
    {
        $this->expectedOutputString('hogefoo')
            ->runFile(__DIR__ . '/data/array-nested-array.php');
    }
}
