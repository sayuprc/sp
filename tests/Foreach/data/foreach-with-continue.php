<?php

foreach (['a', 'b', 'c'] as $item) {
    if ($item === 'b') {
        continue;
    }

    echo $item;
}
