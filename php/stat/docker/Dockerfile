# Docker image with PHP
FROM php:cli-alpine AS php

WORKDIR /var/www

# composer
# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apk add $PHPIZE_DEPS \
#
# ZIP
    && apk add libzip-dev zip \
    && docker-php-ext-install zip \
#
# xDebug is installed, but switched off (without "docker-php-ext-enable xdebug")
    && pecl install xdebug \
#
# Opcache
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache


# Docker image "php" + source code
FROM php AS php-prod
COPY --chown=www-data:www-data ./src /var/www/src


# Docker image "php-prod" + fixtures and unit-tests
FROM php-prod AS php-dev
COPY --chown=www-data:www-data ./tests /var/www/tests
