<?php

declare(strict_types=1);

namespace Tests\Namespace;

use Tests\TestCase;

class NamespaceTest extends TestCase
{
    public function test(): void
    {
        $this->expectedOutputString('namespace-sample-func')
            ->runFile(__DIR__ . '/data/namespace-normal.php');
    }

    public function testCallBuiltInFunction(): void
    {
        $this->expectedOutputString('hige')
            ->runFile(__DIR__ . '/data/namespace-call-built-in-function.php');
    }
}
