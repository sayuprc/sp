<?php

declare(strict_types=1);

namespace Tests\BinaryOp;

use Tests\TestCase;

class BinaryOpTest extends TestCase
{
    public function testPlus(): void
    {
        $this->expectedOutputString('2')
            ->runFile(__DIR__ . '/data/plus.php');
    }

    public function testMinus(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/minus.php');
    }

    public function testMul(): void
    {
        $this->expectedOutputString('4')
            ->runFile(__DIR__ . '/data/mul.php');
    }

    public function testDiv(): void
    {
        $this->expectedOutputString('3')
            ->runFile(__DIR__ . '/data/div.php');
    }

    public function testMod(): void
    {
        $this->expectedOutputString('2')
            ->runFile(__DIR__ . '/data/mod.php');
    }

    public function testPow(): void
    {
        $this->expectedOutputString('9')
            ->runFile(__DIR__ . '/data/pow.php');
    }

    public function testConcat(): void
    {
        $this->expectedOutputString('12')
            ->runFile(__DIR__ . '/data/concat.php');
    }

    public function testSmallerIsTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/smaller-is-true.php');
    }

    public function testSmallerIsFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/smaller-is-false.php');
    }

    public function testSmallerOrEqualIsTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/smaller-or-equal-is-true.php');
    }

    public function testSmallerOrEqualIsFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/smaller-or-equal-is-false.php');
    }

    public function testGreaterIsTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/greater-is-true.php');
    }

    public function testGreaterIsFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/greater-is-false.php');
    }

    public function testGreaterOrEqualIsTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/greater-equal-is-true.php');
    }

    public function testGreaterOrEqualIsFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/greater-equal-is-false.php');
    }

    public function testSpaceshipIsSmaller(): void
    {
        $this->expectedOutputString('-1')
            ->runFile(__DIR__ . '/data/spaceship-is-smaller.php');
    }

    public function testSpaceshipIsEqual(): void
    {
        $this->expectedOutputString('0')
            ->runFile(__DIR__ . '/data/spaceship-is-equal.php');
    }

    public function testSpaceshipIsGreater(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/spaceship-is-greater.php');
    }

    public function testEqualSameType(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/equal-same-type.php');
    }

    public function testNotEqualSameType(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/not-equal-same-type.php');
    }

    public function testEqualNotSameType(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/equal-not-same-type.php');
    }

    public function testNotEqualNotSameType(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/not-equal-not-same-type.php');
    }

    public function testIdenticalSameType(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/identical-same-type.php');
    }

    public function testNotIdenticalSameType(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/not-identical-same-type.php');
    }

    public function testIdenticalNotSameType(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/identical-not-same-type.php');
    }

    public function testNotIdenticalNotSameType(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/not-identical-not-same-type.php');
    }

    public function testBooleanAndIsTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/boolean-and-is-true.php');
    }

    public function testBooleanAndIsFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/boolean-and-is-false.php');
    }

    public function testBooleanOrIsTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/boolean-or-is-true.php');
    }

    public function testBooleanOrIsFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/boolean-or-is-false.php');
    }

    public function testLogicalAndIsTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/logical-and-is-true.php');
    }

    public function testLogicalAndIsFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/logical-and-is-false.php');
    }

    public function testLogicalOrIsTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/logical-or-is-true.php');
    }

    public function testLogicalOrIsFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/logical-or-is-false.php');
    }

    public function testLogicalXorIsTrue(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/logical-xor-is-true.php');
    }

    public function testLogicalXorIsFalse(): void
    {
        $this->expectedOutputString('')
            ->runFile(__DIR__ . '/data/logical-xor-is-false.php');
    }

    public function testCoalesce(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/coalesce.php');
    }

    public function testShiftLeft(): void
    {
        $this->expectedOutputString('44')
            ->runFile(__DIR__ . '/data/shift-left.php');
    }

    public function testShiftRight(): void
    {
        $this->expectedOutputString('2')
            ->runFile(__DIR__ . '/data/shift-right.php');
    }

    public function testBitwiseAnd(): void
    {
        $this->expectedOutputString('0')
            ->runFile(__DIR__ . '/data/bitwise-and.php');
    }

    public function testBitwiseOr(): void
    {
        $this->expectedOutputString('3')
            ->runFile(__DIR__ . '/data/bitwise-or.php');
    }

    public function testBitwiseXor(): void
    {
        $this->expectedOutputString('2')
            ->runFile(__DIR__ . '/data/bitwise-xor.php');
    }
}
