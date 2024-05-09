<?php

declare(strict_types=1);

namespace Tests;

class ForTest extends TestCase
{
    /**
     * @return void
     */
    public function testFor(): void
    {
        $code = <<<CODE
        <?php
        for (\$i = 0; \$i < 10; \$i = \$i + 1) {
            echo \$i;
        }
        CODE;

        $this->expectOutputStringWithCode('0123456789', $code);
    }

    /**
     * @return void
     */
    public function testForWithBreak(): void
    {
        $code = <<<CODE
        <?php
        for (\$i = 0; \$i < 10; \$i = \$i + 1) {
            if (\$i === 2) {
                break;
            }
            echo \$i;
        }
        CODE;

        $this->expectOutputStringWithCode('01', $code);
    }

    /**
     * @return void
     */
    public function testForWithContinue(): void
    {
        $code = <<<CODE
        <?php
        for (\$i = 0; \$i < 10; \$i = \$i + 1) {
            if (\$i === 2) {
                continue;
            }
            echo \$i;
        }
        CODE;

        $this->expectOutputStringWithCode('013456789', $code);
    }
}
