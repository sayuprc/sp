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
    protected function expectOutputStringWithCode(string $expected, string $code): void
    {
        $this->expectOutputString($expected);
        $this->interpreter->run($code);
    }
}
