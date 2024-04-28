<?php

declare(strict_types=1);

namespace Tests;

class IfTest extends TestCase
{
    /**
     * @return void
     */
    public function testIf(): void
    {
        $code = <<<CODE
		<?php
		if (0 < 1) {
			echo 1;
		}
		CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testIfElseIf(): void
    {
        $code = <<<CODE
		<?php
		if (1 < 0) {
			echo 1;
		} elseif (0 < 1) {
			echo 0;
		}
		CODE;

        $this->expectOutputString('0');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testIfElse(): void
    {
        $code = <<<CODE
		<?php
		if (1 < 0) {
			echo 1;
		} else {
			echo 0;
		}
		CODE;

        $this->expectOutputString('0');

        $this->interpreter->run('<?php if (1 < 0) { echo 1; } else { echo 0; }');
    }

    /**
     * @return void
     */
    public function testNestedIf(): void
    {
        $code = <<<CODE
		<?php
		if (0 < 1) {
			if (1 < 2) {
				echo 1;
			}
		}
		CODE;

        $this->expectOutputString('1');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testNestedElseIf(): void
    {
        $code = <<<CODE
		<?php
		if (0 < 1) {
			if (2 < 1) {
				echo 1;
			} elseif (1 < 2) {
				echo 0;
			}
		}
		CODE;

        $this->expectOutputString('0');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testNestedElse(): void
    {
        $code = <<<CODE
		<?php
		if (0 < 1) {
			if (2 < 1) {
				echo 1;
			} else {
				echo 0;
			}
		}
		CODE;

        $this->expectOutputString('0');

        $this->interpreter->run($code);
    }

    /**
     * @return void
     */
    public function testAllTrue(): void
    {
        $code = <<<CODE
		<?php
		if (0 < 1) {
			echo 'a';
		} elseif (0 < 1) {
			echo 'b';
		} else {
			echo 'c';
		}
		CODE;

        $this->expectOutputString('a');

        $this->interpreter->run($code);
    }
}
