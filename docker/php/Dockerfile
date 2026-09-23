FROM php:8.4-fpm-alpine

RUN apk add --no-cache libzip-dev zip unzip icu-dev \
    && docker-php-ext-install pdo_mysql zip intl
    
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /work/web