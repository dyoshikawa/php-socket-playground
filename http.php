<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($socket, '0.0.0.0', 8000);

socket_listen($socket, 1);

echo 'start...';
$remote = socket_accept($socket);

// 本当はループで$bufferを順次読み取るべき
$red = socket_read($remote, 10000);

echo 'log: ' . $red;

socket_write($remote, 'HTTP/1.0 200 OK' . PHP_EOL);
socket_write($remote, 'Content-Type: text/plain' . PHP_EOL);
socket_write($remote, PHP_EOL);
socket_write($remote, 'Hello');

socket_close($remote);

socket_close($socket);