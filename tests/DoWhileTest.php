<?php

declare(strict_types=1);

namespace Tests;

class DoWhileTest extends TestCase
{
    /**
     * @return void
     */
    public function testDoWhile(): void
    {
        $code = <<<CODE
        <?php
        \$i = 0;
        do {
            echo \$i;
        } while (\$i > 0);
        CODE;

        $this->expectOutputStringWithCode('0', $code);
    }
}
