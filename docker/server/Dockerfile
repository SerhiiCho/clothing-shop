FROM php:7.3-fpm

COPY ./start.sh /

RUN apt-get update \
    && apt-get install -y \
        software-properties-common \
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
        curl \
        # supervisor \
        vim \
        zip \
        unzip \
        gnupg \
        gnupg2 \
        gnupg1 \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install  \
    pdo_mysql \
    zip \
    && echo 'alias phpunit="vendor/bin/phpunit"' >> ~/.bashrc \
    && echo 'alias pa="php artisan"' >> ~/.bashrc \
    && chmod u+x /start.sh \
    && curl -sL https://deb.nodesource.com/setup_8.x | bash - \
    && apt-get install -y \
        build-essential \
        nodejs

########## Supervisor ##########
# COPY ./laravel-worker.conf /etc/supervisor/conf.d/