<?php

declare(strict_types=1);

namespace Tests\ConstFetch;

use Tests\TestCase;

class ConstFetchTest extends TestCase
{
    public function testTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/const-fetch-true.php');
    }

    public function testFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/const-fetch-false.php');
    }

    public function testNull(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/const-fetch-null.php');
    }
}
