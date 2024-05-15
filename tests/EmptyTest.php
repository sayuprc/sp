<?php

declare(strict_types=1);

namespace Tests;

class EmptyTest extends TestCase
{
    public function testIntOne(): void
    {
        $code = <<<'CODE'
        <?php
        $var = 1;
        echo empty($var);
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }

    public function testEmptyString(): void
    {
        $code = <<<'CODE'
        <?php
        $var = '';
        echo empty($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testStringZero(): void
    {
        $code = <<<'CODE'
        <?php
        $var = '0';
        echo empty($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testIntZero(): void
    {
        $code = <<<'CODE'
        <?php
        $var = 0;
        echo empty($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testNull(): void
    {
        $code = <<<'CODE'
        <?php
        $var = null;
        echo empty($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testDefined(): void
    {
        $code = <<<'CODE'
        <?php
        $var;
        echo empty($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testEmptyArray(): void
    {
        $code = <<<'CODE'
        <?php
        $var = [];
        echo empty($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testNotEmptyArray(): void
    {
        $code = <<<'CODE'
        <?php
        $var = [1];
        echo empty($var);
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }
}
