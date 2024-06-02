<?php

foreach ([1, 2, 3] as $a) {
    echo $a;

    foreach ([1, 2, 3] as $b) {
        echo $b;

        if ($b === 2) {
            break 2;
        }
    }
}
