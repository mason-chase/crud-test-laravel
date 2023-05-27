FROM php:8.2.1-fpm-alpine3.17

ARG ALPINE_VERSION=3.17

RUN echo https://mirrors.pardisco.co/alpine/v$ALPINE_VERSION/main > /etc/apk/repositories
RUN echo https://mirrors.pardisco.co/alpine/v$ALPINE_VERSION/community >> /etc/apk/repositories


RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"


RUN apk update && apk add --no-cache nginx \
    supervisor \
    curl \
    nano \
    git \
    git-flow \
    vim \
    redis \
    htop \
    mysql-client \
    shadow \
    zip \
    unzip \
    dos2unix \
    libzip-dev \
    $PHPIZE_DEPS \
    libjpeg-turbo-dev \
    linux-headers \
    libpq-dev

# compile native PHP packages
RUN docker-php-ext-install pcntl \
    bcmath \
    opcache \
    pdo_mysql \
    sockets

# Install Postgre PDO
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql pgsql

# install additional packages from PECL
RUN pecl install zip && docker-php-ext-enable zip \
    && pecl install igbinary && docker-php-ext-enable igbinary \
    && yes | pecl install redis && docker-php-ext-enable redis

COPY --from=composer:2.5.1 /usr/bin/composer /usr/local/bin/composer

COPY .docker/dev/config/nginx.conf /etc/nginx/nginx.conf
COPY .docker/dev/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY .docker/dev/config/zz-docker.conf  /usr/local/etc/php-fpm.d/zz-docker.conf

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN chown -R www-data.www-data /var/www/html && \
  chown -R www-data.www-data /run && \
  chown -R www-data.www-data /var/lib/nginx && \
  chown -R www-data.www-data /var/log/nginx

# Switch to use a non-root user from here on
USER www-data

COPY --chown=www-data . /var/www/html/

WORKDIR /var/www/html

RUN chmod 777 -R storage/ \
 && chmod 777 -R bootstrap/cache/

EXPOSE 80

ENTRYPOINT ["./.docker/dev/docker-entrypoint.sh"]
