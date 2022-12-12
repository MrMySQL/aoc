<?php

include_once(__DIR__ . '/shared.php');

const DAY_NUMBER = 4;

$file = getInputByData(DAY_NUMBER);
$pairs = explode("\n", $file);
unset($pairs[count($pairs) - 1]);

$count = 0;
foreach ($pairs as $pair_string) {
    preg_match('/(?<r1_s>\d+)-(?<r1_e>\d+),(?<r2_s>\d+)-(?<r2_e>\d+)/', $pair_string, $matches);
    $r1_s = $matches['r1_s'];
    $r1_e = $matches['r1_e'];
    $r2_s = $matches['r2_s'];
    $r2_e = $matches['r2_e'];

    if (is_overlap($r1_s, $r1_e, $r2_s, $r2_e)) {
        $count++;
    }
}

var_dump($count);

function is_overlap($x_s, $x_e, $y_s, $y_e): bool
{
    $full = ($x_s >= $y_s && $x_e <= $y_e) || ($x_s <= $y_s && $x_e >= $y_e);
    $partial = ($x_s <= $y_s && $x_e >= $y_s) || ($x_s <= $y_e && $x_e >= $y_e);
    return $partial || $full;
}
