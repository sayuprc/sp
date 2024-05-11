<?php

declare(strict_types=1);

namespace Tests;

class EchoTest extends TestCase
{
    public function testEchoString(): void
    {
        $code = <<<'CODE'
        <?php
        echo 'a';
        CODE;

        $this->expectOutputStringWithCode('a', $code);
    }

    public function testEchoInt(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1;
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testEchoFloat(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1.1;
        CODE;

        $this->expectOutputStringWithCode('1.1', $code);
    }

    public function testEchoMultiElements(): void
    {
        $code = <<<'CODE'
        <?php
        echo 'a', 'b';
        CODE;

        $this->expectOutputStringWithCode('ab', $code);
    }
}
