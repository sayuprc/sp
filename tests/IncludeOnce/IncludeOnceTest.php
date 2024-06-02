<?php

declare(strict_types=1);

namespace Tests\IncludeOnce;

use Tests\TestCase;

class IncludeOnceTest extends TestCase
{
    public function testInclude(): void
    {
        $code = <<<'CODE'
        <?php
        include_once 'tests/IncludeOnce/data/include-once.php';
        CODE;

        $this->expectedOutputString('include_once')
            ->runCode($code);
    }

    public function testIncludeTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        include_once 'tests/IncludeOnce/data/include-once.php';
        include_once 'tests/IncludeOnce/data/include-once.php';
        CODE;

        $this->expectedOutputString('include_once')
            ->runCode($code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        include_once 'tests/IncludeOnce/data/not-exists.php';
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }
}
