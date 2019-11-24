# PHPでHTTPサーバ

dyoshikawa

---

## 概要

- PHPで簡易なechoサーバ、httpサーバ、チャットサーバを作ってみる

## 動機

- ソケットプログラミング勉強中のため。
- Laravel勉強会なのでPHP縛りがあると思ったから。
- PHPにもsocket_xxx関数があるようなのでやってみます。

---

## とりあえず

- socket_create
- socket_bind
- socket_listen
- socket_accept
- socket_read
- socket_write
- socket_close

上記を押さえれば最低限動かせる。

---

## socket_create

```php
// TCP
socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
// UDP
socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
```

---

### AF_INET？

https://www.php.net/manual/ja/function.socket-create.php

> AF_INET	IPv4 インターネットプロトコル。 このプロトコルファミリーに属するプロトコルとしてよく知られているのは、 TCP や UDP です。

---

### TCPプロトコル+ストリームソケット

『TCP/IPソケットプログラミング C言語編』

> パケット消失や重複を検出し、再要求するなどして回復できる

→信頼性が高い

---

### UDPプロトコル+データグラムソケット

『TCP/IPソケットプログラミング C言語編』

> 消失したパケットを再要求するような機能がありません

> ベストエフォート型

> UDPを使用する場合は、パケットの消失や重複に対処できるよう、アプリケーションプログラムを作り込んでおく必要があります

→信頼性をアプリケーション側で担保する必要がある

---

### したがって

- (SOCK_STREAM, SOL_TCP)
- (SOCK_DGRAM, SOL_UDP)

はそれぞれセットという認識で良さそう。

---

### 今回は

(簡単そうなので) TCPを使います。

---

## socket_bind

---

```php
socket_bind($socket, '0.0.0.0', 8000);
```

---

https://www.php.net/manual/ja/function.socket-bind.php

> address で指定した名前を socket で指定したソケットにバインドします

ソケットとポートを紐付ける。

---

## socket_listen

---

```php
// 第2引数は同時接続数の最大値を決める。
socket_listen($socket, 1);
```

---

https://www.php.net/manual/ja/function.socket-listen.php

> socket 上の接続要求を待つための通信ができるようになります

『TCP/IPソケットプログラミング C言語編』

> listen()は、クライアントからの接続要求を許可するようTCPの実装に伝えます

---

## socket_accept

---

```php
$remote = socket_accept($socket)
```

---

https://www.php.net/manual/ja/function.socket-accept.php

> この関数は、 このソケットへの接続を許可します

---

### 返り値

> 成功した場合に新規ソケットリソースを、エラー時に FALSE を返します

---

#### 「新規ソケットリソース」？

接続してきたクライアントのソケット情報のこと (たぶん) 。

---

## socket_read / socket_write / socket_close

---

### socket_read

---

```php
socket_read($remote, 1000);
```

---

https://www.php.net/manual/ja/function.socket-read.php

クライアントから送信されてきたバイトを読み込む。

---

### socket_read

---

```php
socket_write($remote, $msg);
```

---

https://www.php.net/manual/ja/function.socket-write.php

クライアントへバイトを送信する。

---

### socket_close

---

```php
socket_close($socket);
```

---

https://www.php.net/manual/ja/function.socket-close.php

ソケットを閉じる。

---

## echoサーバ

---?code=tcp_echo.php

---

## httpサーバ

---?code=http.php

---

## チャットサーバ

---?code=tcp_chat.php
