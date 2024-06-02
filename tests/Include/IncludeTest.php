<?php

declare(strict_types=1);

namespace Tests\Include;

use Tests\TestCase;

class IncludeTest extends TestCase
{
    public function testInclude(): void
    {
        $code = <<<'CODE'
        <?php
        include 'tests/Include/data/include.php';
        CODE;

        $this->expectedOutputString('include')
            ->runCode($code);
    }

    public function testIncludeTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        include 'tests/Include/data/include.php';
        include 'tests/Include/data/include.php';
        CODE;

        $this->expectedOutputString('includeinclude')
            ->runCode($code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        include 'tests/Include/data/not_exists.php';
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }
}
