FROM php:7.3-fpm

COPY ./start.sh /

########## Install packages ##########
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
        \
    ########## Apache2 enable mods ##########
    && a2enmod rewrite \
    ########## Install php extentions ##########
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        gd \
        bz2 \
        zip \
        pcntl \
        bcmath \
        \
    ########## Configure php extentions ##########
    && docker-php-ext-configure \
        gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
        \
    ########## Add aliases to a .bashrc file ##########
    && echo 'alias phpunit="vendor/bin/phpunit"' >> ~/.bashrc \
    && echo 'alias pa="php artisan"' >> ~/.bashrc \
    && chmod u+x /start.sh \
    && curl -sL https://deb.nodesource.com/setup_8.x | bash - \
    && apt-get install -y \
        build-essential \
        nodejs

########## Supervisor ##########
# COPY ./laravel-worker.conf /etc/supervisor/conf.d/