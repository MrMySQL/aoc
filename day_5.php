<?php

const DAY_NUMBER = 5;
const AOC_AUTH_COOKIE = 'AOC_AUTH_COOKIE';

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

var_dump($s);


function getInputByData(int $day): string
{
    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "Accept-language: en\r\nCookie: " . getenv(AOC_AUTH_COOKIE) . "\r\n"
        ]
    ];

    $context = stream_context_create($opts);
    $file = file_get_contents('https://adventofcode.com/2022/day/' . $day . '/input', false, $context);
    return $file;
}
