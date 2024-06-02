<?php

for ($a = 0; $a < 10; $a = $a + 1) {
    echo $a;

    for ($b = 0; $b < 10; $b = $b + 1) {
        echo $b;

        if ($b === 2) {
            break 2;
        }
    }
}
