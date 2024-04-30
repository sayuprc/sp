<?php

declare(strict_types=1);

namespace Tests;

class FunctionTest extends TestCase
{
    /**
     * @return void
     */
    public function testFunction(): void
    {
        $code = <<<CODE
        <?php
        function func()
        {
            return 1 + 1;
        }

        echo func();
        CODE;

        $this->expectOutputStringWithCode('2', $code);
    }

    /**
     * @return void
     */
    public function testFunctionNotReturn(): void
    {
        $code = <<<CODE
        <?php
        function func()
        {
            \$a = 1 + 1;
        }

        echo func();
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }

    /**
     * @return void
     */
    public function testFunctionWithArg(): void
    {
        $code = <<<CODE
        <?php
        function func(\$arg)
        {
            return \$arg + 1;
        }

        echo func(1);
        CODE;

        $this->expectOutputStringWithCode('2', $code);
    }

    /**
     * @return void
     */
    public function testCallVariableWithoutFunctionScope(): void
    {
        $code = <<<CODE
        <?php
        function func()
        {
            return \$arg;
        }

        \$arg = 1;

        echo func();
        CODE;

        $this->expectOutputStringWithCode('', $code);
    }
}
