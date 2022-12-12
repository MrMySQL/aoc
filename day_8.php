<?php

include_once(__DIR__ . '/shared.php');

const DAY_NUMBER = 8;

$file = getInputByData(DAY_NUMBER);
$forest = explode("\n", $file);
array_pop($forest);

foreach ($forest as $l => $line) {
    $forest[$l] = str_split($line);
}

$visible = 0;

for ($y = 1; $y < 98; $y++) {
    for ($x = 1; $x < 98; $x++) {
        //from left
        $array = array_slice($forest[$y], 0, $x);
        rsort($array);
        if ($array[0] < $forest[$y][$x]) {
            $visible++;
            continue;
        }

        //from right
        $array = array_slice($forest[$y], $x+1);
        rsort($array);
        if ($array[0] < $forest[$y][$x]) {
            $visible++;
            continue;
        }


        $line = array_column($forest, $x);

        //from top
        $array = array_slice($line, 0, $y);
        rsort($array);
        if ($array[0] < $forest[$y][$x]) {
            $visible++;
            continue;
        }

        //from bottom
        $array = array_slice($line, $y+1);
        rsort($array);
        if ($array[0] < $forest[$y][$x]) {
            $visible++;
            continue;
        }
    }
}

echo $visible + 99 + 99 + 97 + 97;