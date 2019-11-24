<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($socket, '0.0.0.0', 8000);

socket_listen($socket, 3);

echo 'start...';
while ($remote = socket_accept($socket)) {
    while ($buffer = socket_read($remote, 10000)) {
        socket_write($remote, $buffer);
    }
    socket_close($remote);
}

socket_close($socket);