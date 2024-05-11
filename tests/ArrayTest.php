<?php

declare(strict_types=1);

namespace Tests;

class ArrayTest extends TestCase
{
    public function testArray(): void
    {
        $code = <<<'CODE'
        <?php
        $array = [
            'foo',
            'bar',
            'buz',
        ];
        echo $array[0], $array[2];
        CODE;

        $this->expectOutputStringWithCode('foobuz', $code);
    }

    public function testArrayWithKey(): void
    {
        $code = <<<'CODE'
        <?php
        $array = [
            'foo' => 'hoge',
            'bar' => 'fuga',
            'buz' => 'piyo',
        ];
        echo $array['foo'], $array['buz'];
        CODE;

        $this->expectOutputStringWithCode('hogepiyo', $code);
    }
}
