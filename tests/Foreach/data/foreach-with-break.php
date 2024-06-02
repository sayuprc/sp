<?php

foreach (['a', 'b', 'c'] as $item) {
    if ($item === 'b') {
        break;
    }

    echo $item;
}
