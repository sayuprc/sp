<?php

declare(strict_types=1);

namespace Tests;

use Exception;

class ForTest extends TestCase
{
    public function testFor(): void
    {
        $code = <<<'CODE'
        <?php
        for ($i = 0; $i < 10; $i = $i + 1) {
            echo $i;
        }
        CODE;

        $this->expectOutputStringWithCode('0123456789', $code);
    }

    public function testForWithBreak(): void
    {
        $code = <<<'CODE'
        <?php
        for ($i = 0; $i < 10; $i = $i + 1) {
            if ($i === 2) {
                break;
            }
            echo $i;
        }
        CODE;

        $this->expectOutputStringWithCode('01', $code);
    }

    public function testBreakInNestedFor(): void
    {
        $code = <<<'CODE'
        <?php
        for ($a = 0; $a < 10; $a = $a + 1) {
            echo $a;
            for ($b = 0; $b < 10; $b = $b + 1) {
                echo $b;
                if ($b === 2) {
                    break 2;
                }
            }
        }
        CODE;

        $this->expectOutputStringWithCode('0012', $code);
    }

    public function testInvalidBreakNum(): void
    {
        $code = <<<'CODE'
        <?php
        for ($i = 0; $i < 10; $i = $i + 1) {
            break 2;
        }
        CODE;

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('cannot break 2 levels');

        $this->interpreter->run($code);
    }

    public function testForWithContinue(): void
    {
        $code = <<<'CODE'
        <?php
        for ($i = 0; $i < 10; $i = $i + 1) {
            if ($i === 2) {
                continue;
            }
            echo $i;
        }
        CODE;

        $this->expectOutputStringWithCode('013456789', $code);
    }
}
