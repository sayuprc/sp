<?php

declare(strict_types=1);

namespace Tests;

use PhpParser\ParserFactory;
use PhpParser\PhpVersion;
use PHPUnit\Framework\TestCase as BaseTestCase;
use StrictPhp\Interpreter;

class TestCase extends BaseTestCase
{
    /**
     * @var Interpreter
     */
    protected Interpreter $interpreter;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $parser = (new ParserFactory())->createForVersion(PhpVersion::fromString('8.2'));

        $this->interpreter = new Interpreter($parser);
    }
}
