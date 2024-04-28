<?php

declare(strict_types=1);

namespace Tests;

class IfTest extends TestCase
{
    /**
     * @return void
     */
    public function testIf(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php if (0 < 1) { echo 1; }');
    }

    /**
     * @return void
     */
    public function testIfElseIf(): void
    {
        $this->expectOutputString('0');

        $this->interpreter->run('<?php if (1 < 0) { echo 1; } elseif (0 < 1) { echo 0; }');
    }

    /**
     * @return void
     */
    public function testIfElse(): void
    {
        $this->expectOutputString('0');

        $this->interpreter->run('<?php if (1 < 0) { echo 1; } else { echo 0; }');
    }

    /**
     * @return void
     */
    public function testNestedIf(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php if (0 < 1) { if (1 < 2) { echo 1; } }');
    }

    /**
     * @return void
     */
    public function testNestedElseIf(): void
    {
        $this->expectOutputString('0');

        $this->interpreter->run('<?php if (0 < 1) { if (2 < 1) { echo 1; } elseif (1 < 2) { echo 0; } }');
    }

    /**
     * @return void
     */
    public function testNestedElse(): void
    {
        $this->expectOutputString('0');

        $this->interpreter->run('<?php if (0 < 1) { if (2 < 1) { echo 1; } else { echo 0; } }');
    }
}
