<?php

declare(strict_types=1);

namespace Tests\Match;

use Error;
use Tests\TestCase;

class MatchTest extends TestCase
{
    public function testMatch(): void
    {
        $code = <<<'CODE'
        <?php
        echo match (0 < 1) {
            true => 'ok',
            default => 'no',
        };
        CODE;

        $this->expectedOutputString('ok')
            ->runCode($code);
    }

    public function testMatchDefault(): void
    {
        $code = <<<'CODE'
        <?php
        echo match (0 > 1) {
            true => 'ok',
            default => 'no',
        };
        CODE;

        $this->expectedOutputString('no')
            ->runCode($code);
    }

    public function testMatchUnhandled(): void
    {
        $code = <<<'CODE'
        <?php
        echo match (0 > 1) {
            true => 'ok',
        };
        CODE;

        $this->expectedException(Error::class)
            ->expectedExceptionMessage('Unhandled match case')
            ->runCode($code);
    }
}
