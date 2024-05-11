<?php

declare(strict_types=1);

namespace Tests;

use Error;

class RequireOnceTest extends TestCase
{
    public function testRequireOnce(): void
    {
        $code = <<<'CODE'
        <?php
        require_once 'tests/require_once.php';
        CODE;

        $this->expectOutputStringWithCode('require_once', $code);
    }

    public function testRequireOnceTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        require_once 'tests/require_once.php';
        require_once 'tests/require_once.php';
        CODE;

        $this->expectOutputStringWithCode('require_once', $code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        require_once 'tests/not_exists.php';
        CODE;

        $this->expectException(Error::class);
        $this->expectExceptionMessage("Failed opening required 'tests/not_exists.php'");

        $this->interpreter->run($code);
    }
}
