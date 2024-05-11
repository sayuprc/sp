<?php

declare(strict_types=1);

namespace Tests;

use Error;

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

        $this->expectOutputStringWithCode('ok', $code);
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

        $this->expectOutputStringWithCode('no', $code);
    }

    public function testMatchUnhandled(): void
    {
        $code = <<<'CODE'
        <?php
        echo match (0 > 1) {
            true => 'ok',
        };
        CODE;

        $this->expectException(Error::class);
        $this->expectExceptionMessage('Unhandled match case');

        $this->interpreter->run($code);
    }
}
