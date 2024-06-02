<?php

declare(strict_types=1);

namespace Tests\Switch;

use Tests\TestCase;

class SwitchTest extends TestCase
{
    public function testSwitch(): void
    {
        $this->expectedOutputString('a')
            ->runFile(__DIR__ . '/data/switch-normal.php');
    }

    public function testSwitchDefault(): void
    {
        $this->expectedOutputString('c')
            ->runFile(__DIR__ . '/data/switch-default.php');
    }

    public function testSwitchWithoutBreak(): void
    {
        $this->expectedOutputString('012')
            ->runFile(__DIR__ . '/data/switch-without-break.php');
    }

    public function testSwitchWithMultiCase(): void
    {
        $this->expectedOutputString('ok')
            ->runFile(__DIR__ . '/data/switch-multi-case.php');
    }
}
