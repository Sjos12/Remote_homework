FROM php:7.4-fpm-alpine
ENV XDEBUG_VERSION 2.9.4
# Update system
RUN apk update && apk upgrade \
    && apk add --no-cache ${PHPIZE_DEPS} procps \
    && apk add --no-cache libxml2-dev \
                          freetype \
                           gmp-dev \
                           libpng \
                           libjpeg-turbo \
                           freetype-dev \
                           libpng-dev \
                           libjpeg-turbo-dev \
                           libzip-dev \
                           oniguruma-dev \
    && docker-php-ext-install exif \
    && docker-php-ext-configure gd \
                           --with-freetype=/usr/include/ \
                           --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install mbstring opcache pdo_mysql mysqli soap zip gmp exif

# Cleanup
RUN apk del ${PHPIZE_DEPS} \
    && rm -rf /var/cache/apk/*

# Configuration
# Use the default develop configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Increase maximum execution time
RUN sed -e 's/max_execution_time = 30/max_execution_time = 300/' -i ${PHP_INI_DIR}/php.ini

WORKDIR /app
