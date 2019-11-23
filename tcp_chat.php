<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($socket, '0.0.0.0', 8000);

socket_listen($socket, 1);

echo 'start...';
while ($remote = socket_accept($socket)) {
    $red = socket_read($remote, 10000);
    echo 'log: ' . $red;

    socket_write($remote, $red);
}

socket_close($socket);