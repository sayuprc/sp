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
        include_once 'tests/IncludeOnce/data/include_once.php';
        CODE;

        $this->expectedOutputString('include_once')
            ->runCode($code);
    }

    public function testIncludeTwoTimes(): void
    {
        $code = <<<'CODE'
        <?php
        include_once 'tests/IncludeOnce/data/include_once.php';
        include_once 'tests/IncludeOnce/data/include_once.php';
        CODE;

        $this->expectedOutputString('include_once')
            ->runCode($code);
    }

    public function testNotExistsFile(): void
    {
        $code = <<<'CODE'
        <?php
        include_once 'tests/IncludeOnce/data/not_exists.php';
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }
}
