<?php

declare(strict_types=1);

namespace Tests;

class IncludeOnceTest extends TestCase
{
    public function testInclude(): void
    {
        $code = <<<'CODE'
        <?php
        include_once 'tests/include/include_once.php';
        CODE;

        $this->expectOutputStringWithCode('include_once', $code);
    }

    public function testIncludeTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        include_once 'tests/include/include_once.php';
        include_once 'tests/include/include_once.php';
        CODE;

        $this->expectOutputStringWithCode('include_once', $code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        include_once 'tests/include/not_exists.php';
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }
}
