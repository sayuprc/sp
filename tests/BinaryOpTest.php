<?php

declare(strict_types=1);

namespace Tests;

class BinaryOpTest extends TestCase
{
    /**
     * @return void
     */
    public function testPlus(): void
    {
        $code = <<<CODE
        <?php
        echo 1 + 1;
        CODE;

        $this->expectOutputString('2');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testMinus(): void
    {
        $code = <<<CODE
        <?php
        echo 2 - 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testMul(): void
    {
        $code = <<<CODE
        <?php
        echo 2 * 2;
        CODE;

        $this->expectOutputString('4');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testDiv(): void
    {
        $code = <<<CODE
        <?php
        echo 6 / 2;
        CODE;

        $this->expectOutputString('3');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testMod(): void
    {
        $code = <<<CODE
        <?php
        echo 5 % 3;
        CODE;

        $this->expectOutputString('2');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testPow(): void
    {
        $code = <<<CODE
        <?php
        echo 3 ** 2;
        CODE;

        $this->expectOutputString('9');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testConcat(): void
    {
        $code = <<<CODE
        <?php
        echo 1 . 2;
        CODE;

        $this->expectOutputString('12');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testSmallerIsTrue(): void
    {
        $code = <<<CODE
        <?php
        echo 1 < 2;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testSmallerIsFalse(): void
    {
        $code = <<<CODE
        <?php
        echo 2 < 1;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testSmallerOrEqualIsTrue(): void
    {
        $code = <<<CODE
        <?php
        echo 1 <= 2;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testSmallerOrEqualIsFalse(): void
    {
        $code = <<<CODE
        <?php
        echo 2 <= 1;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testGreaterIsTrue(): void
    {
        $code = <<<CODE
        <?php
        echo 2 > 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testGreaterIsFalse(): void
    {
        $code = <<<CODE
        <?php
        echo 1 > 2;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testGreaterOrEqualIsTrue(): void
    {
        $code = <<<CODE
        <?php
        echo 2 >= 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testGreaterOrEqualIsFalse(): void
    {
        $code = <<<CODE
        <?php
        echo 1 >= 2;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testSpaceshipIsSmaller(): void
    {
        $code = <<<CODE
        <?php
        echo 1 <=> 2;
        CODE;

        $this->expectOutputString('-1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testSpaceshipIsEqual(): void
    {
        $code = <<<CODE
        <?php
        echo 1 <=> 1;
        CODE;

        $this->expectOutputString('0');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testSpaceshipIsGreater(): void
    {
        $code = <<<CODE
        <?php
        echo 2 <=> 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testEqualSameType(): void
    {
        $code = <<<CODE
        <?php
        echo 1 == 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testNotEqualSameType(): void
    {
        $code = <<<CODE
        <?php
        echo 1 != 0;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testEqualNotSameType(): void
    {
        $code = <<<CODE
        <?php
        echo 1 == '1';
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testNotEqualNotSameType(): void
    {
        $code = <<<CODE
        <?php
        echo 1 != '0';
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testIdenticalSameType(): void
    {
        $code = <<<CODE
        <?php
        echo 1 === 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testNotIdenticalSameType(): void
    {
        $code = <<<CODE
        <?php
        echo 1 !== 0;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testIdenticalNotSameType(): void
    {
        $code = <<<CODE
        <?php
        echo 1 === '1';
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testNotIdenticalNotSameType(): void
    {
        $code = <<<CODE
        <?php
        echo 1 !== '1';
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testBooleanAndIsTrue(): void
    {
        $code = <<<CODE
        <?php
        echo 1 && 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testBooleanAndIsFalse(): void
    {
        $code = <<<CODE
        <?php
        echo 1 && 0;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testBooleanOrIsTrue(): void
    {
        $code = <<<CODE
        <?php
        echo 1 || 0;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testBooleanOrIsFalse(): void
    {
        $code = <<<CODE
        <?php
        echo 0 || 0;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testLogicalAndIsTrue(): void
    {
        $code = <<<CODE
        <?php
        echo 1 and 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testLogicalAndIsFalse(): void
    {
        $code = <<<CODE
        <?php
        echo 1 and 0;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testLogicalOrIsTrue(): void
    {
        $code = <<<CODE
        <?php
        echo 1 or 0;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testLogicalOrIsFalse(): void
    {
        $code = <<<CODE
        <?php
        echo 0 or 0;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * true xor false => true
     *
     * @return void
     */
    public function testLogicalXorIsTrue(): void
    {
        $code = <<<CODE
        <?php
        echo 1 xor 0;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * true xor true => false
     *
     * @return void
     */
    public function testLogicalXorIsFalse(): void
    {
        $code = <<<CODE
        <?php
        echo 1 xor 1;
        CODE;

        $this->expectOutputString('');

        $this->interpreter->run($code);
    }

    /**
     * FIXME ConstFetch is not implemented, so it will be tested again after implementation
     *
     * @return void
     */
    public function testCoalesce(): void
    {
        $code = <<<CODE
        <?php
        echo null ?? 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testShiftLeft(): void
    {
        $code = <<<CODE
        <?php
        echo 11 << 2;
        CODE;

        $this->expectOutputString('44');

        // 11 => 00001011
        // << 2 => 00101100 => 44

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testShiftRight(): void
    {
        $code = <<<CODE
        <?php
        echo 10 >> 2;
        CODE;

        $this->expectOutputString('2');

        // 10 => 00001010
        // >> 2 => 00000010 => 2

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testBitwiseAnd(): void
    {
        $code = <<<CODE
        <?php
        echo 1 & 2;
        CODE;

        // 1 => 00000001
        // 2 => 00000010
        // & => 00000000

        $this->expectOutputString('0');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testBitwiseOr(): void
    {
        $code = <<<CODE
        <?php
        echo 1 | 2;
        CODE;

        // 1 => 00000001
        // 2 => 00000010
        // | => 00000011

        $this->expectOutputString('3');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testBitwiseXor(): void
    {
        $code = <<<CODE
        <?php
        echo 1 ^ 3;
        CODE;

        // 1 => 00000001
        // 3 => 00000011
        // ^ => 00000010

        $this->expectOutputString('2');

        $this->interpreter->run($code);
    }
}
