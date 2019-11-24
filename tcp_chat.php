<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

try {
    socket_bind($socket, '0.0.0.0', 8000);
    socket_listen($socket, 5);

    echo 'start...';
    /** @var $remotes array */
    $remotes = [];
    echo '1人目を待っています。' . PHP_EOL;
    array_push($remotes, socket_accept($socket));
    echo '1人目が入りました。' . PHP_EOL;
    echo '2人目を待っています。' . PHP_EOL;
    array_push($remotes, socket_accept($socket));
    echo '2人目が入りました。' . PHP_EOL;
    echo 'チャット開始' . PHP_EOL;

    $thread = new class($remotes) extends Thread
    {
        /** @var $remotes array */
        public $remotes;

        /**
         * @param $remotes array
         */
        public function __construct($remotes)
        {
            $this->remotes = $remotes;
        }

        public function run()
        {
            while ($buffer = socket_read($this->remotes[0], 1000)) {
                socket_write($this->remotes[1], $buffer);
            }
        }
    };

    $thread->start();

    while ($buffer = socket_read($remotes[1], 1000)) {
        socket_write($remotes[0], $buffer);
    }

} finally {
    $thread->join();
    foreach ($remotes as $remote) {
        socket_close($remote);
    }
    socket_close($socket);
}
