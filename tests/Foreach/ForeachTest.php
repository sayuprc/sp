<?php

declare(strict_types=1);

namespace Tests\Foreach;

use Exception;
use Tests\TestCase;

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

        $this->expectedOutputString('abc')
            ->runCode($code);
    }

    public function testForeachWithKey(): void
    {
        $code = <<<'CODE'
        <?php
        foreach (['a', 'b', 'c'] as $key => $item) {
            echo $key . '=>' . $item;
        }
        CODE;

        $this->expectedOutputString('0=>a1=>b2=>c')
            ->runCode($code);
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

        $this->expectedOutputString('a')
            ->runCode($code);
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

        $this->expectedOutputString('112')
            ->runCode($code);
    }

    public function testInvalidBreakNum(): void
    {
        $code = <<<'CODE'
        <?php
        foreach ([1, 2, 3] as $a) {
            break 2;
        }
        CODE;

        $this->expectedException(Exception::class)
            ->expectedExceptionMessage('cannot break 2 levels')
            ->runCode($code);
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

        $this->expectedOutputString('ac')
            ->runCode($code);
    }
}
