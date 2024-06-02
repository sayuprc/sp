<?php

declare(strict_types=1);

namespace Tests;

use PhpParser\ParserFactory;
use PhpParser\PhpVersion;
use PHPUnit\Framework\TestCase as BaseTestCase;
use StrictPhp\Interpreter;

class TestCase extends BaseTestCase
{
    protected Interpreter $interpreter;

    protected function setUp(): void
    {
        parent::setUp();

        $parser = (new ParserFactory())->createForVersion(PhpVersion::fromString('8.2'));

        $this->interpreter = new Interpreter($parser);
    }

    /**
     * @param non-empty-string $code
     */
    protected function runCode(string $code): void
    {
        $this->interpreter->run($code);
    }

    protected function expectedOutputString(string $expected): self
    {
        $this->expectOutputString($expected);

        return $this;
    }

    /**
     * @param class-string $exception
     */
    protected function expectedException(string $exception): self
    {
        $this->expectException($exception);

        return $this;
    }

    protected function expectedExceptionMessage(string $message): self
    {
        $this->expectExceptionMessage($message);

        return $this;
    }
}
