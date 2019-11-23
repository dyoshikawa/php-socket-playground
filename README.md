```bash
php tcp_echo.php
```

別のターミナルを開き、

```bash
echo 'hello' | nc localhost 8000
```

とすると `hello` が返ってくる。