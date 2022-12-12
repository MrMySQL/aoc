<?php

include_once(__DIR__ . '/shared.php');

const DAY_NUMBER = 2;

const MAP = [
    'A X' => 1+3,
    'A Y' => 2+6,
    'A Z' => 3+0,
    'B X' => 1+0,
    'B Y' => 2+3,
    'B Z' => 3+6,
    'C X' => 1+6,
    'C Y' => 2+0,
    'C Z' => 3+3,
];

const MAP2 = [
    'A X' => 3,
    'A Y' => 4,
    'A Z' => 8,
    'B X' => 1,
    'B Y' => 5,
    'B Z' => 9,
    'C X' => 1+6,
    'C Y' => 2+0,
    'C Z' => 3+3,
];

$file = getInputByData(DAY_NUMBER);
$rounds = explode("\n", $file);
$rounds = array_map(function($s){
    return MAP2[$s] ?? 0;
}, $rounds);
var_dump(array_sum($rounds));
