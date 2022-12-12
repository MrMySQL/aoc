<?php

const DAY_NUMBER = 7;
const AOC_AUTH_COOKIE = 'AOC_AUTH_COOKIE';

$file = getInputByData(DAY_NUMBER);
$command_groups = explode("\n$ ", $file);
array_shift($command_groups);
//var_dump($command_groups[array_key_last($command_groups)]);exit;


$tree = [];
$pointer = &$tree;
$current_path = [];

foreach ($command_groups as $command_group) {
    $commands = explode("\n", $command_group);
    if ($commands[array_key_last($commands)] === '') {
        array_pop($commands);
    }

    // it's ls
    if (count($commands) > 1) {
        array_shift($commands);
        create_structure_in_folder($pointer, $commands, $current_path);
        continue;
    }

    // it's `cd ..`
    if ($command_group === 'cd ..') {
        unset($current_path[array_key_last($current_path)]);
        $pointer = &$tree;
        if ($current_path) {
            foreach ($current_path as $path) {
                $pointer = &$pointer[$path];
            }
        }
    } else {
        // it's `cd folder`
        $folder_name = explode(' ', $commands[0])[1];
        $current_path[] = $folder_name;
        $pointer = &$pointer[$folder_name];
    }
}

$space_to_free = 30_000_000 - (70_000_000 - State::$folder_size['/']);

State::$folder_size = array_filter(State::$folder_size, function ($v) use ($space_to_free) {
    return $v >= $space_to_free;
});

sort(State::$folder_size);
var_dump(State::$folder_size[0]);exit;


function create_structure_in_folder(array &$folder, $commands, $current_path)
{
    foreach ($commands as $command) {
        $list = explode(' ', $command);
        if ($list[0] === 'dir') {
            // it's folder
            $folder[$list[1]] = [];
        } else {
            // it's file, write size
            $size = (int)$list[0];
            $folder[$list[1]] = $size;
            count_folder_size($current_path, $size);
        }
    }
}

function count_folder_size($current_path, int $size): void
{
    State::$folder_size['/'] += $size;
    for ($i = 1; $i <= count($current_path); $i++) {
        $path = join('/', array_slice($current_path, 0, $i));
        State::$folder_size[$path] = isset(State::$folder_size[$path]) ? State::$folder_size[$path] + $size : $size;
    }
}

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

class State
{
    public static array $folder_size = ['/' => 0];
}