FROM php:8.2-fpm

ENV GOSU_VERSION=1.11 \
    USER=app \
    HOME=/home/app

RUN apt-get update -y && apt-get install -y --no-install-recommends --fix-missing \
        $PHPIZE_DEPS \
        curl \
        libcurl4-openssl-dev \
        libtool \
        libxml2-dev \
        libsqlite3-dev \
        imagemagick \
        default-mysql-client \
        libicu-dev \
        libzip-dev \
        libjpeg-dev \
        libpng-dev \
        libonig-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev
RUN docker-php-ext-install \
        bcmath \
        gd \
        curl \
        dom \
        iconv \
        bcmath \
        mbstring \
        pdo \
        pdo_mysql \
        pdo_sqlite \
        pcntl \
        xml \
        zip \
        intl
RUN apt-get install -y --no-install-recommends --fix-missing \
       nano \
       openssh-client \
       zsh
RUN apt-get install -y --no-install-recommends --fix-missing \
       wget \
       git \
    && curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN set -x \
    && apt-get update \
    && apt-get install -y \
        dpkg \
        gnupg \
        openssl \
    && dpkgArch="$(dpkg --print-architecture | awk -F- '{ print $NF }')" \
    && wget -O /usr/local/bin/gosu "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch" \
    && wget -O /usr/local/bin/gosu.asc "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch.asc" \
    && export GNUPGHOME="$(mktemp -d)" \
    && rm -r "$GNUPGHOME" /usr/local/bin/gosu.asc \
    && chmod +x /usr/local/bin/gosu \
    && gosu nobody true \
    && apt-get autoremove -y \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
RUN apt-get update && apt-get install -y passwd \
    && addgroup --system app \
    && adduser --system --ingroup app --shell /bin/zsh --home /home/app app \
    && usermod -aG app www-data \
    && chown app:app -R /home/app \
    && apt-get install -y git \
    && gosu app git clone https://github.com/robbyrussell/oh-my-zsh.git /home/app/.oh-my-zsh \
    && gosu app cp /home/app/.oh-my-zsh/templates/zshrc.zsh-template /home/app/.zshrc \
    && gosu app sed -i 's/ZSH_THEME=".*"/ZSH_THEME="candy"/g' /home/app/.zshrc \
    && apt-get remove -y git \
    && apt-get autoremove -y \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
RUN apt-get install -y $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN apt-get update && apt-get install -y zlib1g fontconfig libx11-6 libxext6 libxrender1 libsqlite3-0
RUN apt-get update && apt-get install -y libfreetype6 libpng16-16 libjpeg62-turbo libfreetype6-dev libpng-dev libjpeg62-turbo-dev
RUN pear config-set php_bin /usr/local/bin/phpexit
RUN pear install php_codesniffer
WORKDIR $HOME/solutions_apps
RUN apt-get install -y supervisor


RUN pecl install redis && docker-php-ext-enable redis

# Implementations for crontab
RUN apt-get update && apt-get install -y libcap2-bin busybox && setcap cap_setgid=ep /bin/busybox
RUN echo_supervisord_conf > /etc/supervisord.conf
RUN apt-get update && apt-get install -y cron && touch /var/log/cron.log


USER app
RUN mkdir /home/app/crontabs \
        && echo 'SHELL=/bin/sh' > /home/app/crontabs/app \
    && echo "* * * * * /usr/local/bin/php /home/app/solutions_apps/artisan schedule:run >> /dev/null 2>&1" >> /home/app/crontabs/app \
    && echo "* * * * * /usr/local/bin/php /home/app/sale_system/artisan schedule:run >> /dev/null 2>&1" >> /home/app/crontabs/app
USER root
RUN /usr/bin/crontab /home/app/crontabs/app
RUN docker-php-ext-install -j$(nproc) soap

EXPOSE 9000
