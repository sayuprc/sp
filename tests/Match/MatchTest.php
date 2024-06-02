<?php

declare(strict_types=1);

namespace Tests\Match;

use Error;
use Tests\TestCase;

class MatchTest extends TestCase
{
    public function testMatch(): void
    {
        $this->expectedOutputString('ok')
            ->runFile(__DIR__ . '/data/match-normal.php');
    }

    public function testMatchDefault(): void
    {
        $this->expectedOutputString('no')
            ->runFile(__DIR__ . '/data/match-default.php');
    }

    public function testMatchUnhandled(): void
    {
        $this->expectedException(Error::class)
            ->expectedExceptionMessage('Unhandled match case')
            ->runFile(__DIR__ . '/data/match-unhandled.php');
    }
}
