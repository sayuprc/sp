<?php

$a = 'hoge';

$b = fn ($a) => $a;

echo $b('fuga'), $a;
