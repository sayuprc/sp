<?php

declare(strict_types=1);

namespace Tests\Echo;

use Tests\TestCase;

class EchoTest extends TestCase
{
    public function testEchoString(): void
    {
        $this->expectedOutputString('a')
            ->runFile(__DIR__ . '/data/echo-string.php');
    }

    public function testEchoInt(): void
    {
        $this->expectedOutputString('1')
            ->runFile(__DIR__ . '/data/echo-int.php');
    }

    public function testEchoFloat(): void
    {
        $this->expectedOutputString('1.1')
            ->runFile(__DIR__ . '/data/echo-float.php');
    }

    public function testEchoMultiElements(): void
    {
        $this->expectedOutputString('ab')
            ->runFile(__DIR__ . '/data/echo-multi-elements.php');
    }
}
