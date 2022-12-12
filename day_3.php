<?php

include_once(__DIR__ . '/shared.php');

const DAY_NUMBER = 3;

$map = join('', range('a', 'z')) . join('', range('A', 'Z'));

$file = getInputByData(DAY_NUMBER);
$rucksacks = explode("\n", $file);
$priorities = [];

$rucksacks_by_3 = array_chunk($rucksacks, 3);
unset($rucksacks_by_3[count($rucksacks_by_3)-1]);

foreach ($rucksacks_by_3 as $i => $chunk) {
    $chunk = array_map(function ($rucksack) {
        return str_split($rucksack);
    }, $chunk);

    $intersect = array_intersect(...$chunk);
    $intersect = reset($intersect);
    $priorities[] = strpos($map, $intersect) + 1;
}

var_dump(array_sum($priorities));
