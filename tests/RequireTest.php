<?php

declare(strict_types=1);

namespace Tests;

use Error;

class RequireTest extends TestCase
{
    public function testRequire(): void
    {
        $code = <<<'CODE'
        <?php
        require 'tests/require.php';
        CODE;

        $this->expectOutputStringWithCode('require', $code);
    }

    public function testRequireTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        require 'tests/require.php';
        require 'tests/require.php';
        CODE;

        $this->expectOutputStringWithCode('requirerequire', $code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        require 'tests/not_exists.php';
        CODE;

        $this->expectException(Error::class);
        $this->expectExceptionMessage("Failed opening required 'tests/not_exists.php'");

        $this->interpreter->run($code);
    }
}
