FROM composer:2.3
FROM php:8-fpm-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

ARG xdebug=1

RUN apk add --no-cache --virtual .persistent-deps \
		git \
		icu-libs \
		libpq \
		rabbitmq-c-dev \
		zlib \
		autoconf \
		automake \
		g++ \
		make

ENV APCU_VERSION 5.1.21
RUN set -xe \
	&& apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
		icu-dev \
		postgresql-dev \
		zlib-dev \
        libzip-dev \
        pcre-dev \
        zip \
    && install-php-extensions \
		intl \
		pdo_mysql \
		zip \
		bcmath \
		sockets \
    && pecl install \
	    amqp \
		apcu-${APCU_VERSION} \
    && docker-php-ext-enable --ini-name 20-apcu.ini apcu sockets amqp \
	&& docker-php-ext-enable --ini-name 05-opcache.ini opcache bcmath \
	&& apk del .build-deps

# Install XDebug
RUN if [ "$xdebug" -eq "1" ]; then \
        install-php-extensions xdebug \
    ;fi

COPY --from=0 /usr/bin/composer /usr/bin/composer
COPY docker/php/conf.d/php.ini /usr/local/etc/php/php.ini
COPY docker/php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY docker/php/conf.d/error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini
COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

WORKDIR /srv
ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER 1

# Prevent the reinstallation of vendors at every changes in the source code
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress \
	&& composer clear-cache

COPY . ./

ENV PHP_IDE_CONFIG="serverName=localhost"

RUN mkdir -p var/cache var/logs var/sessions \
	&& composer dump-autoload --classmap-authoritative --no-dev \
	&& chown -R www-data var
