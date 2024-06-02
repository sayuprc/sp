<?php

declare(strict_types=1);

namespace Tests\BinaryOp;

use Tests\TestCase;

class BinaryOpTest extends TestCase
{
    public function testPlus(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 + 1;
        CODE;

        $this->expectedOutputString('2')
            ->runCode($code);
    }

    public function testMinus(): void
    {
        $code = <<<'CODE'
        <?php
        echo 2 - 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testMul(): void
    {
        $code = <<<'CODE'
        <?php
        echo 2 * 2;
        CODE;

        $this->expectedOutputString('4')
            ->runCode($code);
    }

    public function testDiv(): void
    {
        $code = <<<'CODE'
        <?php
        echo 6 / 2;
        CODE;

        $this->expectedOutputString('3')
            ->runCode($code);
    }

    public function testMod(): void
    {
        $code = <<<'CODE'
        <?php
        echo 5 % 3;
        CODE;

        $this->expectedOutputString('2')
            ->runCode($code);
    }

    public function testPow(): void
    {
        $code = <<<'CODE'
        <?php
        echo 3 ** 2;
        CODE;

        $this->expectedOutputString('9')
            ->runCode($code);
    }

    public function testConcat(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 . 2;
        CODE;

        $this->expectedOutputString('12')
            ->runCode($code);
    }

    public function testSmallerIsTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 < 2;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testSmallerIsFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo 2 < 1;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testSmallerOrEqualIsTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 <= 2;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testSmallerOrEqualIsFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo 2 <= 1;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testGreaterIsTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo 2 > 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testGreaterIsFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 > 2;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testGreaterOrEqualIsTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo 2 >= 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testGreaterOrEqualIsFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 >= 2;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testSpaceshipIsSmaller(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 <=> 2;
        CODE;

        $this->expectedOutputString('-1')
            ->runCode($code);
    }

    public function testSpaceshipIsEqual(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 <=> 1;
        CODE;

        $this->expectedOutputString('0')
            ->runCode($code);
    }

    public function testSpaceshipIsGreater(): void
    {
        $code = <<<'CODE'
        <?php
        echo 2 <=> 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testEqualSameType(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 == 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testNotEqualSameType(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 != 0;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testEqualNotSameType(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 == '1';
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testNotEqualNotSameType(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 != '0';
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testIdenticalSameType(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 === 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testNotIdenticalSameType(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 !== 0;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testIdenticalNotSameType(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 === '1';
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testNotIdenticalNotSameType(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 !== '1';
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testBooleanAndIsTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 && 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testBooleanAndIsFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 && 0;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testBooleanOrIsTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 || 0;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testBooleanOrIsFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo 0 || 0;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testLogicalAndIsTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 and 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testLogicalAndIsFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 and 0;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testLogicalOrIsTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 or 0;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testLogicalOrIsFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo 0 or 0;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testLogicalXorIsTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 xor 0;
        CODE;

        // true xor false => true

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testLogicalXorIsFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 xor 1;
        CODE;

        // true xor true => false

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testCoalesce(): void
    {
        $code = <<<'CODE'
        <?php
        echo null ?? 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testShiftLeft(): void
    {
        $code = <<<'CODE'
        <?php
        echo 11 << 2;
        CODE;

        // 11 => 00001011
        // << 2 => 00101100 => 44

        $this->expectedOutputString('44')
            ->runCode($code);
    }

    public function testShiftRight(): void
    {
        $code = <<<'CODE'
        <?php
        echo 10 >> 2;
        CODE;

        // 10 => 00001010
        // >> 2 => 00000010 => 2

        $this->expectedOutputString('2')
            ->runCode($code);
    }

    public function testBitwiseAnd(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 & 2;
        CODE;

        // 1 => 00000001
        // 2 => 00000010
        // & => 00000000

        $this->expectedOutputString('0')
            ->runCode($code);
    }

    public function testBitwiseOr(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 | 2;
        CODE;

        // 1 => 00000001
        // 2 => 00000010
        // | => 00000011

        $this->expectedOutputString('3')
            ->runCode($code);
    }

    public function testBitwiseXor(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1 ^ 3;
        CODE;

        // 1 => 00000001
        // 3 => 00000011
        // ^ => 00000010

        $this->expectedOutputString('2')
            ->runCode($code);
    }
}
