<?php

declare(strict_types=1);

namespace Tests;

class ConstFetchTest extends TestCase
{
    public function testTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo true;
        CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo false;
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }

    public function testNull(): void
    {
        $code = <<<'CODE'
        <?php
        echo null;
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }
}
