<?php

declare(strict_types=1);

namespace Tests;

use Exception;

class WhileTest extends TestCase
{
    public function testWhile(): void
    {
        $code = <<<'CODE'
        <?php
        $i = 0;
        while ($i < 10) {
            echo $i;
            $i = $i + 1;
        }
        CODE;

        $this->expectOutputStringWithCode('0123456789', $code);
    }

    public function testWhileBreak(): void
    {
        $code = <<<'CODE'
        <?php
        $i = 0;
        while ($i < 10) {
            if ($i === 2) {
                break;
            }
            echo $i;
            $i = $i + 1;
        }
        CODE;

        $this->expectOutputStringWithCode('01', $code);
    }

    public function testBreakInNestedWhile(): void
    {
        $code = <<<'CODE'
        <?php
        $a = 0;
        $b = 0;
        while ($a < 10) {
            echo $a;
            while ($b < 10) {
                echo $b;
                if ($b === 2) {
                    break 2;
                }
                $b = $b + 1;
            }
            $a = $a + 1;
        }
        CODE;

        $this->expectOutputStringWithCode('0012', $code);
    }

    public function testInvalidBreakNum(): void
    {
        $code = <<<'CODE'
        <?php
        while (true) {
            break 2;
        }
        CODE;

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('cannot break 2 levels');

        $this->interpreter->run($code);
    }

    public function testWhileContinue(): void
    {
        $code = <<<'CODE'
        <?php
        $i = 0;
        while ($i < 10) {
            if ($i === 2) {
                $i = $i + 1;
                continue;
            }
            echo $i;
            $i = $i + 1;
        }
        CODE;

        $this->expectOutputStringWithCode('013456789', $code);
    }
}
