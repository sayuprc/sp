<?php

declare(strict_types=1);

namespace Tests;

use Exception;

class DoWhileTest extends TestCase
{
    /**
     * @return void
     */
    public function testDoWhile(): void
    {
        $code = <<<CODE
        <?php
        \$i = 0;
        do {
            echo \$i;
        } while (\$i > 0);
        CODE;

        $this->expectOutputStringWithCode('0', $code);
    }

    public function testBreakInNestedDoWhile(): void
    {
        $code = <<<'CODE'
        <?php
        $a = 0;
        $b = 0;
        do {
            echo $a;
            do {
                echo $b;
                if ($b === 2) {
                    break 2;
                }
                $b = $b + 1;
            } while ($b < 10);
            $a = $a + 1;
        } while ($a < 10);
        CODE;

        $this->expectOutputStringWithCode('0012', $code);
    }

    public function testInvalidBreakNum(): void
    {
        $code = <<<'CODE'
        <?php
        do {
            break 2;
        } while (true);
        CODE;

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('cannot break 2 levels');

        $this->interpreter->run($code);
    }
}
