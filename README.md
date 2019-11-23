```bash
php tcp_echo.php
```

別のターミナルを開き、

```bash
echo 'hello' | nc localhost 8000
```

とすると `hello` が返ってくる。

https://gist.github.com/andrewmackrodt/db3840103bb6be4ece87a7d16a73dd5b