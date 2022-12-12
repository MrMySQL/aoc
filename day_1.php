<?php

include_once(__DIR__ . '/shared.php');

const DAY_NUMBER = 1;

$file = getInputByData(DAY_NUMBER);

$elves = explode("\n\n", $file);
foreach($elves as $id => $elve) {
    $elves[$id] = array_sum(explode("\n", $elve));
}
rsort($elves);
$chunks = array_chunk($elves, 3);
var_dump(array_sum($chunks[0]));
