<?php

declare(strict_types=1);

namespace Tests\ConstFetch;

use Tests\TestCase;

class ConstFetchTest extends TestCase
{
    public function testTrue(): void
    {
        $code = <<<'CODE'
        <?php
        echo true;
        CODE;

        $this->expectedOutputString('1')
            ->runCode($code);
    }

    public function testFalse(): void
    {
        $code = <<<'CODE'
        <?php
        echo false;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }

    public function testNull(): void
    {
        $code = <<<'CODE'
        <?php
        echo null;
        CODE;

        $this->expectedOutputString('')
            ->runCode($code);
    }
}
