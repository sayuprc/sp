<?php

declare(strict_types=1);

namespace Tests;

class SwitchTest extends TestCase
{
    public function testSwitch(): void
    {
        $code = <<<'CODE'
        <?php
        switch ('a') {
            case 'a':
                echo 'a';
                break;
            case 'b':
                echo 'b';
                break;
            default:
                echo 'c';
        }
        CODE;

        $this->expectOutputStringWithCode('a', $code);
    }

    public function testSwitchDefault(): void
    {
        $code = <<<'CODE'
        <?php
        switch (0) {
            case 'a':
                echo 'a';
                break;
            case 'b':
                echo 'b';
                break;
            default:
                echo 'c';
        }
        CODE;

        $this->expectOutputStringWithCode('c', $code);
    }

    public function testSwitchWithoutBreak(): void
    {
        $code = <<<'CODE'
        <?php
        switch (0) {
            case 0:
                echo 0;
            case 1:
                echo 1;
            case 2:
                echo 2;
        }
        CODE;

        $this->expectOutputStringWithCode('012', $code);
    }

    public function testSwitchWithMultiCase(): void
    {
        $code = <<<'CODE'
        <?php
        switch (0) {
            case 0:
            case 1:
                echo 'ok';
                break;
            case 2:
                echo 2;
        }
        CODE;

        $this->expectOutputStringWithCode('ok', $code);
    }
}
