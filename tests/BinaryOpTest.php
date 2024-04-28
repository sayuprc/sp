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
        $this->expectOutputString('2');

        $this->interpreter->run('<?php echo 1 + 1;');
    }

    /**
     * @return void
     */
    public function testMinus(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 2 - 1;');
    }

    /**
     * @return void
     */
    public function testMul(): void
    {
        $this->expectOutputString('4');

        $this->interpreter->run('<?php echo 2 * 2;');
    }

    /**
     * @return void
     */
    public function testDiv(): void
    {
        $this->expectOutputString('3');

        $this->interpreter->run('<?php echo 6 / 2;');
    }

    /**
     * @return void
     */
    public function testMod(): void
    {
        $this->expectOutputString('2');

        $this->interpreter->run('<?php echo 5 % 3;');
    }

    /**
     * @return void
     */
    public function testPow(): void
    {
        $this->expectOutputString('9');

        $this->interpreter->run('<?php echo 3 ** 2;');
    }

    /**
     * @return void
     */
    public function testConcat(): void
    {
        $this->expectOutputString('12');

        $this->interpreter->run('<?php echo 1 . 2;');
    }

    /**
     * @return void
     */
    public function testSmallerIsTrue(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 < 2;');
    }

    /**
     * @return void
     */
    public function testSmallerIsFalse(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run('<?php echo 2 < 1;');
    }

    /**
     * @return void
     */
    public function testSmallerOrEqualIsTrue(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 <= 2;');
    }

    /**
     * @return void
     */
    public function testSmallerOrEqualIsFalse(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run('<?php echo 2 <= 1;');
    }

    /**
     * @return void
     */
    public function testGreaterIsTrue(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 2 > 1;');
    }

    /**
     * @return void
     */
    public function testGreaterIsFalse(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run('<?php echo 1 > 2;');
    }

    /**
     * @return void
     */
    public function testGreaterOrEqualIsTrue(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 2 > 1;');
    }

    /**
     * @return void
     */
    public function testGreaterOrEqualIsFalse(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run('<?php echo 1 >= 2;');
    }

    /**
     * @return void
     */
    public function testSpaceshipIsSmaller(): void
    {
        $this->expectOutputString('-1');

        $this->interpreter->run('<?php echo 1 <=> 2;');
    }

    /**
     * @return void
     */
    public function testSpaceshipIsEqual(): void
    {
        $this->expectOutputString('0');

        $this->interpreter->run('<?php echo 1 <=> 1;');
    }

    /**
     * @return void
     */
    public function testSpaceshipIsGreater(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 2 <=> 1;');
    }

    /**
     * @return void
     */
    public function testEqualSameType(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 == 1;');
    }

    /**
     * @return void
     */
    public function testNotEqualSameType(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 != 0;');
    }

    /**
     * @return void
     */
    public function testEqualNotSameType(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run("<?php echo 1 == '1';");
    }

    /**
     * @return void
     */
    public function testNotEqualNotSameType(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run("<?php echo 1 != '0';");
    }

    /**
     * @return void
     */
    public function testIdenticalSameType(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 === 1;');
    }

    /**
     * @return void
     */
    public function testNotIdenticalSameType(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 !== 0;');
    }

    /**
     * @return void
     */
    public function testIdenticalNotSameType(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run("<?php echo 1 === '1';");
    }

    /**
     * @return void
     */
    public function testNotIdenticalNotSameType(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run("<?php echo 1 !== '1';");
    }

    /**
     * @return void
     */
    public function testBooleanAndIsTrue(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 && 1;');
    }

    /**
     * @return void
     */
    public function testBooleanAndIsFalse(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run('<?php echo 1 && 0;');
    }

    /**
     * @return void
     */
    public function testBooleanOrIsTrue(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 || 0;');
    }

    /**
     * @return void
     */
    public function testBooleanOrIsFalse(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run('<?php echo 0 || 0;');
    }

    /**
     * @return void
     */
    public function testLogicalAndIsTrue(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 and 1;');
    }

    /**
     * @return void
     */
    public function testLogicalAndIsFalse(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run('<?php echo 1 and 0;');
    }

    /**
     * @return void
     */
    public function testLogicalOrIsTrue(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 or 0;');
    }

    /**
     * @return void
     */
    public function testLogicalOrIsFalse(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run('<?php echo 0 or 0;');
    }

    /**
     * true xor false => true
     *
     * @return void
     */
    public function testLogicalXorIsTrue(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1 xor 0;');
    }

    /**
     * true xor true => false
     *
     * @return void
     */
    public function testLogicalXorIsFalse(): void
    {
        $this->expectOutputString('');

        $this->interpreter->run('<?php echo 1 xor 1;');
    }

    /**
     * FIXME ConstFetch is not implemented, so it will be tested again after implementation
     *
     * @return void
     */
    public function testCoalesce(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo null ?? 1;');
    }

    /**
     * @return void
     */
    public function testShiftLeft(): void
    {
        $this->expectOutputString('44');

        // 11 => 00001011
        // << 2 => 00101100 => 44

        $this->interpreter->run('<?php echo 11 << 2;');
    }

    /**
     * @return void
     */
    public function testShiftRight(): void
    {
        $this->expectOutputString('2');

        // 10 => 00001010
        // >> 2 => 00000010 => 2

        $this->interpreter->run('<?php echo 10 >> 2;');
    }

    /**
     * @return void
     */
    public function testBitwiseAnd(): void
    {
        // 1 => 00000001
        // 2 => 00000010
        // & => 00000000

        $this->expectOutputString('0');

        $this->interpreter->run('<?php echo 1 & 2;');
    }

    /**
     * @return void
     */
    public function testBitwiseOr(): void
    {
        // 1 => 00000001
        // 2 => 00000010
        // | => 00000011

        $this->expectOutputString('3');

        $this->interpreter->run('<?php echo 1 | 2;');
    }

    /**
     * @return void
     */
    public function testBitwiseXor(): void
    {
        // 1 => 00000001
        // 3 => 00000011
        // ^ => 00000010

        $this->expectOutputString('2');

        $this->interpreter->run('<?php echo 1 ^ 3;');
    }
}
