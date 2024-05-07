FROM php:8.3-fpm-alpine as app

#extensões para o xdebug
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin

RUN apk update

COPY ./docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

# instala Postgre PDO
RUN set -eux; \
	apk add libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && install-php-extensions pdo pdo_pgsql pgsql

ENV COMPOSER_ALLOW_SUPERUSER=1

# copia composer.json
COPY ./app/composer.* ./

# copia imagem do composer usando multi-stage
COPY --from=composer:2.7.4 /usr/bin/composer /usr/bin/composer 

# instla o composer
RUN composer install --ignore-platform-reqs

# roda o autoload do composer
RUN composer dump-autoload --optimize

# copia os arquivos da aplicação
COPY ./app .

FROM app as app_dev

ENV XDEBUG_MODE=debug

#copia xdebug config para o container
COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

#installa xdebug
RUN set -eux; \
	install-php-extensions xdebug