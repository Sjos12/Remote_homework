FROM php:7.4-fpm-alpine

ENV XDEBUG_VERSION 3.0.4

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
                           libwebp-dev \
                           libzip-dev \
                           oniguruma-dev \
    && docker-php-ext-install exif \
    && docker-php-ext-configure gd \
                           --with-freetype=/usr/include/ \
                           --with-jpeg=/usr/include/ \
                           --with-webp=/usr/include/ \
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

# Custom PHP config, overruling defaults
COPY custom.ini $PHP_INI_DIR/conf.d/zz-custom.ini

# Xdebug config
COPY xdebug.ini $PHP_INI_DIR/conf.d/zz-xdebug.ini

## Sync the www-data user to be the same as host, to allow setting
## file permissions on host that match. Debian / Ubuntu for instance defaults
## to uid / gid 33:33, while nginx:alpine does 82:82. Docker syncs uid and gid,
## not the name of user and group. So without this, setting to www-data:www-data
## on host Ubuntu results in files being owned by xfs:xfs (as that is
## the the 33:33 user / group on nginx:alpine. @see LaraDock repo
## Configure non-root user.
## Set default values, allow to overrule through env var
#ARG PUID=1000
#ENV PUID ${PHP_FPM_PUID}
#ARG PGID=1000
#ENV PGID ${PHP_FPM_PGID}
#
## `-o` + `-g <group-id-or-name>` allows changing gid to non-unique value
## `-o` + `-u <user-id-or-name>` allows changing uid to non-unique value
## `-g www-data` adds the specified user to the group `www-data`.
#RUN apk add shadow && \
#    groupmod -o -g ${PGID} www-data && \
#    usermod -o -u ${PUID} -g www-data www-data
# @todo: this is development only (and perhaps not working on OSX / not necessary on OSX). Debian / Ubuntu first normal user is often 1000. Host permissions are passed by uid and gid to mounted volumes. By setting www-data user to same as host user, has all permissions (but probably more than necessary). It is needed, since Ubuntu / Debian www-data is 33:33, vs nginx:alpine using 82:82. In that case setting to chown -R www-data:www-data on host results in container having 33:33, which doesn't map to www-data, but to xfs and results in permission denied errors. Setting to 82:82 on host has the reverse effect, user doesn't exist in host and have permission errors when editing files on host
RUN apk add shadow && \
    usermod -u 1000 www-data && \
    groupmod  -g 1000 www-data

WORKDIR /app
