<?php

declare(strict_types=1);

namespace Tests\RequireOnce;

use Tests\TestCase;
use Error;

class RequireOnceTest extends TestCase
{
    public function testRequireOnce(): void
    {
        $code = <<<'CODE'
        <?php
        require_once 'tests/RequireOnce/data/require-once.php';
        CODE;

        $this->expectedOutputString('require_once')
            ->runCode($code);
    }

    public function testRequireOnceTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        require_once 'tests/RequireOnce/data/require-once.php';
        require_once 'tests/RequireOnce/data/require-once.php';
        CODE;

        $this->expectedOutputString('require_once')
            ->runCode($code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        require_once 'tests/RequireOnce/data/not-exists.php';
        CODE;

        $this->expectedException(Error::class)
            ->expectedExceptionMessage("Failed opening required 'tests/RequireOnce/data/not-exists.php'")
            ->runCode($code);
    }
}
