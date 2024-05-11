<?php

declare(strict_types=1);

namespace Tests;

use Exception;

class ForeachTest extends TestCase
{
    public function testForeach(): void
    {
        $code = <<<'CODE'
        <?php
        foreach (['a', 'b', 'c'] as $item) {
            echo $item;
        }
        CODE;

        $this->expectOutputStringWithCode('abc', $code);
    }

    public function testForeachWithKey(): void
    {
        $code = <<<'CODE'
        <?php
        foreach (['a', 'b', 'c'] as $key => $item) {
            echo $key . '=>' . $item;
        }
        CODE;

        $this->expectOutputStringWithCode('0=>a1=>b2=>c', $code);
    }

    public function testForeachWithBreak(): void
    {
        $code = <<<'CODE'
        <?php
        foreach (['a', 'b', 'c'] as $item) {
            if ($item === 'b') {
                break;
            }
            echo $item;
        }
        CODE;

        $this->expectOutputStringWithCode('a', $code);
    }

    public function testBreakInNestedForeach(): void
    {
        $code = <<<'CODE'
        <?php
        foreach ([1, 2, 3] as $a) {
            echo $a;
            foreach ([1, 2, 3] as $b) {
                echo $b;
                if ($b === 2) {
                    break 2;
                }
            }
        }
        CODE;

        $this->expectOutputStringWithCode('112', $code);
    }

    public function testInvalidBreakNum(): void
    {
        $code = <<<'CODE'
        <?php
        foreach ([1, 2, 3] as $a) {
            break 2;
        }
        CODE;

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('cannot break 2 levels');

        $this->interpreter->run($code);
    }

    public function testForeachWithContinue(): void
    {
        $code = <<<'CODE'
        <?php
        foreach (['a', 'b', 'c'] as $item) {
            if ($item === 'b') {
                continue;
            }
            echo $item;
        }
        CODE;

        $this->expectOutputStringWithCode('ac', $code);
    }
}
