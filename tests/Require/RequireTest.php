<?php

declare(strict_types=1);

namespace Tests\Require;

use Tests\TestCase;
use Error;

class RequireTest extends TestCase
{
    public function testRequire(): void
    {
        $code = <<<'CODE'
        <?php
        require 'tests/Require/data/require.php';
        CODE;

        $this->expectedOutputString('require')
            ->runCode($code);
    }

    public function testRequireTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        require 'tests/Require/data/require.php';
        require 'tests/Require/data/require.php';
        CODE;

        $this->expectedOutputString('requirerequire')
            ->runCode($code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        require 'tests/Require/data/not_exists.php';
        CODE;

        $this->expectedException(Error::class)
            ->expectedExceptionMessage("Failed opening required 'tests/Require/data/not_exists.php'")
            ->runCode($code);
    }
}
