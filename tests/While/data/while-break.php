<?php

$i = 0;

while ($i < 10) {
    if ($i === 2) {
        break;
    }

    echo $i;

    $i = $i + 1;
}
