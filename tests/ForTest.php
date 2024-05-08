<?php

declare(strict_types=1);

namespace Tests;

class ForTest extends TestCase
{
    /**
     * @return void
     */
    public function testFor(): void
    {
        $code = <<<CODE
        <?php
        for (\$i = 0; \$i < 10; \$i = \$i + 1) {
            echo \$i;
        }
        CODE;

        $this->expectOutputStringWithCode('0123456789', $code);
    }
}
