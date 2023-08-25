FROM php:fpm-alpine

RUN docker-php-ext-install pdo_mysql

RUN apk add --update linux-headers

RUN apk add git autoconf g++ libtool make \
    rm -rf /tmp/* && \
    rm -rf /var/cache/apk/*

# Install Xdebug from source
RUN git clone -b xdebug_3_2 https://github.com/xdebug/xdebug.git /root/xdebug \
  && cd /root/xdebug && phpize; ./configure --enable-xdebug; make; make install;

WORKDIR /var/www/app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
