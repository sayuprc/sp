<?php

declare(strict_types=1);

namespace Tests;

class EchoTest extends TestCase
{
    /**
     * @return void
     */
    public function testEchoString(): void
    {
        $code = <<<CODE
        <?php
        echo 'a';
        CODE;

        $this->expectOutputString('a');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testEchoInt(): void
    {
        $code = <<<CODE
        <?php
        echo 1;
        CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testEchoFloat(): void
    {
        $code = <<<CODE
        <?php
        echo 1.1;
        CODE;

        $this->expectOutputString('1.1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testEchoMultiElements(): void
    {
        $code = <<<CODE
        <?php
        echo 'a', 'b';
        CODE;

        $this->expectOutputString('ab');

        $this->interpreter->run($code);
    }
}
