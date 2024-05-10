<?php

declare(strict_types=1);

namespace Tests;

use Exception;

class AssignTest extends TestCase
{
    /**
     * @return void
     */
    public function testAssign(): void
    {
        $code = <<<'CODE'
        <?php
        $var = 'a';
        echo $var;
        CODE;

        $this->expectOutputStringWithCode('a', $code);
    }

    /**
     * @return void
     */
    public function testNotAssign(): void
    {
        $code = <<<'CODE'
        <?php
        echo $var;
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }

    /**
     * @return void
     */
    public function testMultipleAssign(): void
    {
        $code = <<<'CODE'
        <?php
        $foo = $bar = $baz = 10;
        echo $foo, $bar, $baz;
        CODE;

        $this->expectOutputStringWithCode('101010', $code);
    }

    /**
     * @return void
     */
    public function testAssignThis(): void
    {
        $code = <<<'CODE'
        <?php
        $this = 1;
        CODE;

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('cannot re-assign $this');

        $this->interpreter->run($code);
    }
}
