<?php

declare(strict_types=1);

namespace Tests\Array;

use Tests\TestCase;

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

        $this->expectedOutputString('foobuz')
            ->runCode($code);
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

        $this->expectedOutputString('hogepiyo')
            ->runCode($code);
    }

    public function testNestedArray(): void
    {
        $code = <<<'CODE'
        <?php
        $array = [
            [
                'hoge',
                'fuga',
            ],
            [
                'foo',
                'bar',
            ],
        ];
        echo $array[0][0], $array[1][0];
        CODE;

        $this->expectedOutputString('hogefoo')
            ->runCode($code);
    }
}
