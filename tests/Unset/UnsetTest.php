<?php

declare(strict_types=1);

namespace Tests\Unset;

use Tests\TestCase;

class UnsetTest extends TestCase
{
    public function test(): void
    {
        $this->expectedOutputString('fuga')
            ->runFile(__DIR__ . '/data/unset-normal.php');
    }

    public function testUnsetMulti(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/unset-multi.php');
    }
}
