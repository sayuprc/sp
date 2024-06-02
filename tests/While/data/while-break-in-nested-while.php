<?php

$a = 0;
$b = 0;

while ($a < 10) {
    echo $a;

    while ($b < 10) {
        echo $b;

        if ($b === 2) {
            break 2;
        }

        $b = $b + 1;
    }

    $a = $a + 1;
}
