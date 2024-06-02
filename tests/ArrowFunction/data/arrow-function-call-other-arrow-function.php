<?php

$funcA = fn () => 'arrow_func_a';

$funcB = fn () => 'arrow_func_b/' . $funcA();

echo $funcB();
