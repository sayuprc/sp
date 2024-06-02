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

        $this->expectOutputStringWithCode('require', $code);
    }

    public function testRequireTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        require 'tests/Require/data/require.php';
        require 'tests/Require/data/require.php';
        CODE;

        $this->expectOutputStringWithCode('requirerequire', $code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        require 'tests/Require/data/not_exists.php';
        CODE;

        $this->expectException(Error::class);
        $this->expectExceptionMessage("Failed opening required 'tests/Require/data/not_exists.php'");

        $this->interpreter->run($code);
    }
}
