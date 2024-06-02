<?php

declare(strict_types=1);

namespace Tests\If;

use Tests\TestCase;

class IfTest extends TestCase
{
    public function testIf(): void
    {
        $this->expectedOutputString('if')
            ->runFile(__DIR__ . '/data/if-normal.php');
    }

    public function testIfElseIf(): void
    {
        $this->expectedOutputString('if-else-if')
            ->runFile(__DIR__ . '/data/if-else-if.php');
    }

    public function testIfElse(): void
    {
        $this->expectedOutputString('if-else')
            ->runFile(__DIR__ . '/data/if-else.php');
    }

    public function testNestedIf(): void
    {
        $this->expectedOutputString('nested-if')
            ->runFile(__DIR__ . '/data/if-nested-if.php');
    }

    public function testNestedElseIf(): void
    {
        $this->expectedOutputString('nested-else-if')
            ->runFile(__DIR__ . '/data/if-nested-else-if.php');
    }

    public function testNestedElse(): void
    {
        $this->expectedOutputString('nested-else')
            ->runFile(__DIR__ . '/data/if-nested-else.php');
    }

    public function testAllTrue(): void
    {
        $this->expectedOutputString('all-true')
            ->runFile(__DIR__ . '/data/if-all-true.php');
    }
}
