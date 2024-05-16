<?php

declare(strict_types=1);

namespace Tests;

class IncludeTest extends TestCase
{
    public function testInclude(): void
    {
        $code = <<<'CODE'
        <?php
        include 'tests/include/include.php';
        CODE;

        $this->expectOutputStringWithCode('include', $code);
    }

    public function testIncludeTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        include 'tests/include/include.php';
        include 'tests/include/include.php';
        CODE;

        $this->expectOutputStringWithCode('includeinclude', $code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        include 'tests/include/not_exists.php';
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }
}
