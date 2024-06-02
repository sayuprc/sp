<?php

declare(strict_types=1);

namespace Tests\If;

use Tests\TestCase;

class IfTest extends TestCase
{
    public function testIf(): void
    {
        $code = <<<'CODE'
		<?php
		if (0 < 1) {
			echo 1;
		}
		CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testIfElseIf(): void
    {
        $code = <<<'CODE'
		<?php
		if (1 < 0) {
			echo 1;
		} elseif (0 < 1) {
			echo 0;
		}
		CODE;

        $this->expectOutputStringWithCode('0', $code);
    }

    public function testIfElse(): void
    {
        $code = <<<'CODE'
		<?php
		if (1 < 0) {
			echo 1;
		} else {
			echo 0;
		}
		CODE;

        $this->expectOutputStringWithCode('0', $code);
    }

    public function testNestedIf(): void
    {
        $code = <<<'CODE'
		<?php
		if (0 < 1) {
			if (1 < 2) {
				echo 1;
			}
		}
		CODE;

        $this->expectOutputStringWithCode('1', $code);
    }

    public function testNestedElseIf(): void
    {
        $code = <<<'CODE'
		<?php
		if (0 < 1) {
			if (2 < 1) {
				echo 1;
			} elseif (1 < 2) {
				echo 0;
			}
		}
		CODE;

        $this->expectOutputStringWithCode('0', $code);
    }

    public function testNestedElse(): void
    {
        $code = <<<'CODE'
		<?php
		if (0 < 1) {
			if (2 < 1) {
				echo 1;
			} else {
				echo 0;
			}
		}
		CODE;

        $this->expectOutputStringWithCode('0', $code);
    }

    public function testAllTrue(): void
    {
        $code = <<<'CODE'
		<?php
		if (0 < 1) {
			echo 'a';
		} elseif (0 < 1) {
			echo 'b';
		} else {
			echo 'c';
		}
		CODE;

        $this->expectOutputStringWithCode('a', $code);
    }
}
