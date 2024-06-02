<?php

declare(strict_types=1);

namespace Tests\Empty;

use Tests\TestCase;

class EmptyTest extends TestCase
{
    public function testIntOne(): void
    {
        $code = <<<'CODE'
        <?php
        $var = 1;
        echo empty($var);
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testEmptyString(): void
    {
        $code = <<<'CODE'
        <?php
        $var = '';
        echo empty($var);
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testStringZero(): void
    {
        $code = <<<'CODE'
        <?php
        $var = '0';
        echo empty($var);
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testIntZero(): void
    {
        $code = <<<'CODE'
        <?php
        $var = 0;
        echo empty($var);
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testNull(): void
    {
        $code = <<<'CODE'
        <?php
        $var = null;
        echo empty($var);
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testDefined(): void
    {
        $code = <<<'CODE'
        <?php
        $var;
        echo empty($var);
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testEmptyArray(): void
    {
        $code = <<<'CODE'
        <?php
        $var = [];
        echo empty($var);
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testNotEmptyArray(): void
    {
        $code = <<<'CODE'
        <?php
        $var = [1];
        echo empty($var);
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }
}
