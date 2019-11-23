<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($socket, '0.0.0.0', 8000);

socket_listen($socket, 3);

echo 'start...';
$remotes = [];
while ($remote = socket_accept($socket)) {
    array_push($remotes, $remote);
    while ($buffer = socket_read($remote, 10000)) {
//        socket_write($remote, $buffer);
        foreach ($remotes as $r) {
            socket_write($r, $buffer);
        }
    }
}

socket_close($socket);