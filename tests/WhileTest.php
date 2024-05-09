<?php

declare(strict_types=1);

namespace Tests;

class WhileTest extends TestCase
{
    /**
     * @return void
     */
    public function testWhile(): void
    {
        $code = <<<CODE
        <?php
        \$i = 0;
        while (\$i < 10) {
            echo \$i;
            \$i = \$i + 1;
        }
        CODE;

        $this->expectOutputStringWithCode('0123456789', $code);
    }

    /**
     * @return void
     */
    public function testWhileBreak(): void
    {
        $code = <<<CODE
        <?php
        \$i = 0;
        while (\$i < 10) {
            if (\$i === 2) {
                break;
            }
            echo \$i;
            \$i = \$i + 1;
        }
        CODE;

        $this->expectOutputStringWithCode('01', $code);
    }

    /**
     * @return void
     */
    public function testWhileContinue(): void
    {
        $code = <<<CODE
        <?php
        \$i = 0;
        while (\$i < 10) {
            if (\$i === 2) {
                \$i = \$i + 1;
                continue;
            }
            echo \$i;
            \$i = \$i + 1;
        }
        CODE;

        $this->expectOutputStringWithCode('013456789', $code);
    }
}
