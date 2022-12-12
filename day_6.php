<?php

include_once(__DIR__ . '/shared.php');

const DAY_NUMBER = 6;

$file = getInputByData(DAY_NUMBER);

for ($i = 0; $i < strlen($file); $i++) {
    if (count(array_unique(str_split(substr($file, $i, 14)))) === 14) {
        echo $i+14;
        exit;
    }
}

