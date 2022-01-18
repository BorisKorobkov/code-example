# Docker image with PHP
FROM php:fpm-alpine AS php

# composer
# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apk add $PHPIZE_DEPS \
#
# ZIP
    && apk add libzip-dev zip \
    && docker-php-ext-install zip \
#
# ZeroMQ
#    && apk add zeromq zeromq-dev \
#    && pecl install zmq-beta \
#    && docker-php-ext-enable zmq \
#
# MySQL
    && docker-php-ext-install mysqli pdo pdo_mysql \
#
# PostgreSQL
#    && apk add postgresql-dev \
#    && docker-php-ext-install pdo pdo_pgsql \
#
# GD, iconv
#    && apk add freetype-dev libjpeg-turbo-dev libpng-dev \
#    && docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" iconv \
#    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
#    && docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" gd \
#
# Imagick
#    && apk add autoconf g++ imagemagick-dev libtool make pcre-dev \
#    && pecl install imagick \
#    && docker-php-ext-enable imagick \
#    && apk del autoconf g++ libtool make pcre-dev \
#
# Git
#    && apk add git openssh \
#
# xDebug is installed, but switched off (without "docker-php-ext-enable xdebug")
    && pecl install xdebug \
#
# Opcache
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache


# Docker image with PHP and source code "Code-example"
FROM php AS code-example

# PHP src
COPY --chown=www-data:www-data src_php/ /var/www/
