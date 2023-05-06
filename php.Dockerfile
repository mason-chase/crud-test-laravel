FROM php:8.2-apache 
RUN a2enmod rewrite
RUN apt-get update && apt-get install -y  \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev\
    openssl\
    curl\
    zip\
    unzip

RUN docker-php-ext-install bcmath 
RUN docker-php-ext-install mysqli 
RUN docker-php-ext-install pdo 
RUN docker-php-ext-install pdo_mysql 

RUN echo "nameserver 1.1.1.1" | tee /etc/resolv.conf
RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer 