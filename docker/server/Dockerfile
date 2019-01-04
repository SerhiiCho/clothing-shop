FROM php:7.3-apache

COPY ./start.sh /

RUN docker-php-ext-install \
    pdo_mysql \
    && a2enmod rewrite \
    && apt-get update \
    && apt-get install -y \
        apt-utils \
        libpng-dev \
        libjpeg-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libbz2-dev \
        libmcrypt-dev \
        libcurl3 \
        libcurl3-dev \
        libzip-dev \
        libcurl3 \
        libcurl3-dev \
        mysql-client \
        build-essential \
        vim \
        zip \
        unzip \
        software-properties-common \
        gnupg \
        gnupg2 \
        gnupg1 \
        supervisor \
    && mkdir -p /var/log/supervisor \
    && mkdir -p /etc/supervisor/conf.d \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && echo 'alias phpunit="vendor/bin/phpunit"' >> ~/.bashrc \
    && echo 'alias pa="php artisan"' >> ~/.bashrc \
    && chmod u+x /start.sh

COPY laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf