<?php

function funcA()
{
    return 'func_a';
}

$funcB = fn () => 'func_b/' . funcA();

echo $funcB();
