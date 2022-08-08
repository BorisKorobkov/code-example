# Docker image with PHP
# https://hub.docker.com/_/php
FROM php:8.0.5-fpm-alpine AS php

# composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

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


# Docker image with PHP and source code
FROM php AS php-dev

# PHP src
COPY --chown=www-data:www-data ./ /var/www/
RUN composer install
