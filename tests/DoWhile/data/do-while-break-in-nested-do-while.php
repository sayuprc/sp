<?php

$a = 0;
$b = 0;

do {
    echo $a;

    do {
        echo $b;

        if ($b === 2) {
            break 2;
        }

        $b = $b + 1;
    } while ($b < 10);

    $a = $a + 1;
} while ($a < 10);
