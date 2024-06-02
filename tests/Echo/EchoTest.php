<?php

declare(strict_types=1);

namespace Tests\Echo;

use Tests\TestCase;

class EchoTest extends TestCase
{
    public function testEchoString(): void
    {
        $code = <<<'CODE'
        <?php
        echo 'a';
        CODE;

        $this->expectedOutputString('a')
            ->runCode($code);
    }

    public function testEchoInt(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testEchoFloat(): void
    {
        $code = <<<'CODE'
        <?php
        echo 1.1;
        CODE;

        $this->expectedOutputString('1.1')
            ->runCode($code);
    }

    public function testEchoMultiElements(): void
    {
        $code = <<<'CODE'
        <?php
        echo 'a', 'b';
        CODE;

        $this->expectedOutputString('ab')
            ->runCode($code);
    }
}
