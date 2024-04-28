<?php

declare(strict_types=1);

namespace Tests;

class EchoTest extends TestCase
{
    /**
     * @return void
     */
    public function testEchoString(): void
    {
        $this->expectOutputString('a');

        $this->interpreter->run("<?php echo 'a';");
    }

    /**
     * @return void
     */
    public function testEchoInt(): void
    {
        $this->expectOutputString('1');

        $this->interpreter->run('<?php echo 1;');
    }

    /**
     * @return void
     */
    public function testEchoFloat(): void
    {
        $this->expectOutputString('1.1');

        $this->interpreter->run('<?php echo 1.1;');
    }

    /**
     * @return void
     */
    public function testEchoMultiElements(): void
    {
        $this->expectOutputString('ab');

        $this->interpreter->run('<?php echo "a", "b";');
    }
}
