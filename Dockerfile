ARG COMPOSER_VERSION
ARG PHP_VERSION

FROM composer:${COMPOSER_VERSION} as composer_image
FROM php:${PHP_VERSION}
COPY --from=composer_image /usr/bin/composer /usr/bin/composer
RUN apt-get update \
	&& apt-get install -y \
    git \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip

WORKDIR /app