<?php

declare(strict_types=1);

namespace Tests;

class AssignTest extends TestCase
{
    /**
     * @return void
     */
    public function testAssign(): void
    {
        $code = <<<CODE
        <?php
        \$var = 'a';
        echo \$var;
        CODE;

        $this->expectOutputString('a');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testNotAssign(): void
    {
        $code = <<<CODE
        <?php
        echo \$var;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testMultipleAssign(): void
    {
        $code = <<<CODE
        <?php
        \$foo = \$bar = \$baz = 10;
        echo \$foo, \$bar, \$baz;
        CODE;

        $this->expectOutputString('101010');

        $this->interpreter->run($code);
    }
}
