<?php

declare(strict_types=1);

namespace Tests;

class WhileTest extends TestCase
{
    /**
     * @return void
     */
    public function testWhile(): void
    {
        $code = <<<CODE
        <?php
        \$i = 0;
        while (\$i < 10) {
            echo \$i;
            \$i = \$i + 1;
        }
        CODE;

        $this->expectOutputStringWithCode('0123456789', $code);
    }
}
