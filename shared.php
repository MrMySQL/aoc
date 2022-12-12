<?php

const AOC_AUTH_COOKIE = 'AOC_AUTH_COOKIE';

function get_configs(): array
{
    $configs = file_get_contents(__DIR__ . '/config.json');
    return json_decode($configs, true);
}

function get_config(string $name): string
{
    $configs = get_configs();
    return $configs[$name] ?? null;
}

function getInputByData(int $day): string
{
    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "Accept-language: en\r\nCookie: session=" . get_config(AOC_AUTH_COOKIE) . "\r\n"
        ]
    ];

    $context = stream_context_create($opts);
    $file = file_get_contents('https://adventofcode.com/2022/day/' . $day . '/input', false, $context);
    return $file;
}
