<?php

declare(strict_types=1);

namespace Tests;

class ExitTest extends TestCase
{
    public function testExitZero(): void
    {
        exec('bin/sp -r "exit;"', $output, $exitCode);

        $this->assertSame(0, $exitCode);
    }

    public function testExitError(): void
    {
        exec('bin/sp -r "exit(100);"', $output, $exitCode);

        $this->assertSame(100, $exitCode);
    }
}
