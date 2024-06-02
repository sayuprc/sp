<?php

$i = 0;

while ($i < 10) {
    if ($i === 2) {
        $i = $i + 1;

        continue;
    }

    echo $i;

    $i = $i + 1;
}
