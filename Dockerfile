FROM php:7.2-rc-zts-alpine

RUN apk update && apk add --no-cache \
    sudo bash \
    g++ make autoconf \
    libxml2-dev icu-dev curl-dev pcre-dev

RUN curl -sSL https://github.com/krakjoe/pthreads/archive/master.zip -o /tmp/pthreads.zip \
    && unzip /tmp/pthreads.zip -d /tmp \
    && cd /tmp/pthreads-* \
    && phpize \
    && ./configure \
    && make \
    && make install \
    && rm -rf /tmp/pthreads*

RUN docker-php-ext-enable pthreads

RUN docker-php-ext-install sockets