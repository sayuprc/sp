<?php

declare(strict_types=1);

namespace Tests;

class ForeachTest extends TestCase
{
    /**
     * @return void
     */
    public function testForeach(): void
    {
        $code = <<<CODE
        <?php
        foreach (['a', 'b', 'c'] as \$item) {
            echo \$item;
        }
        CODE;

        $this->expectOutputStringWithCode('abc', $code);
    }

    /**
     * @return void
     */
    public function testForeachWithKey(): void
    {
        $code = <<<CODE
        <?php
        foreach (['a', 'b', 'c'] as \$key => \$item) {
            echo \$key . '=>' . \$item;
        }
        CODE;

        $this->expectOutputStringWithCode('0=>a1=>b2=>c', $code);
    }
}
