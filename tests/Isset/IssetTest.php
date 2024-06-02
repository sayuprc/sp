<?php

declare(strict_types=1);

namespace Tests\Isset;

use Tests\TestCase;

class IssetTest extends TestCase
{
    public function testSetString(): void
    {
        $code = <<<'CODE'
        <?php
        $var = 'var';
        echo isset($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testSetTruthyInt(): void
    {
        $code = <<<'CODE'
        <?php
        $var = 1;
        echo isset($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testSetFalsyInt(): void
    {
        $code = <<<'CODE'
        <?php
        $var = 0;
        echo isset($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testSetTrue(): void
    {
        $code = <<<'CODE'
        <?php
        $var = true;
        echo isset($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testSetFalse(): void
    {
        $code = <<<'CODE'
        <?php
        $var = false;
        echo isset($var);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testSetNull(): void
    {
        $code = <<<'CODE'
        <?php
        $var = null;
        echo isset($var);
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }

    public function testNotSet(): void
    {
        $code = <<<'CODE'
        <?php
        echo isset($var);
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }

    public function testAllSet(): void
    {
        $code = <<<'CODE'
        <?php
        $foo = 'var';
        $bar = 'var';
        echo isset($foo, $bar);
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testNotAllSet(): void
    {
        $code = <<<'CODE'
        <?php
        $foo = 'var';
        echo isset($foo, $bar);
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }
}
