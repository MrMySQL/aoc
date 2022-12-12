<?php

include_once(__DIR__ . '/shared.php');

const DAY_NUMBER = 5;

$file = getInputByData(DAY_NUMBER);
$instructions = explode("\n", $file);
unset($instructions[count($instructions)-1]);

$instructions = array_splice($instructions, 10);

//haha, yeah, this one was faster to be done manually
$stacks = [
    'GDVZJSB',
    'ZSMGVP',
    'CLBSWTQF',
    'HJGWMRVQ',
    'CLSNFMD',
    'RGCD',
    'HGTRJDSQ',
    'PFV',
    'DRSTJ',
];

foreach ($instructions as $instruction) {
    preg_match('/move (\d+) from (\d+) to (\d+)/', $instruction, $matches);
    $amount = $matches[1];
    $from = (int)$matches[2] - 1;
    $to = (int)$matches[3] - 1;

    $substr = substr($stacks[$from], -$amount);
    $stacks[$from] = substr($stacks[$from], 0, strlen($stacks[$from]) - $amount);
    $stacks[$to] .= $substr;
}
$s = '';

foreach ($stacks as $stack) {
    $s .= substr($stack, -1);
}

echo $s;
