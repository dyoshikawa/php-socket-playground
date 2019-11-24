<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($socket, '0.0.0.0', 8000);

socket_listen($socket, 1);

echo 'start...' . PHP_EOL;
$remote = socket_accept($socket);

// 本当はループで$bufferを順次読み取るべき
$red = socket_read($remote, 10000);
myLogger($red);

socket_write($remote, 'HTTP/1.0 200 OK' . PHP_EOL);
socket_write($remote, 'Content-Type: text/plain' . PHP_EOL);
socket_write($remote, PHP_EOL);
socket_write($remote, 'Hello' . PHP_EOL);

socket_close($remote);

socket_close($socket);

function myLogger(string $str)
{
    $explodeds = explode(PHP_EOL, $str);
    foreach ($explodeds as $exploded) {
        echo 'log: ' . $exploded . PHP_EOL;
    }
}