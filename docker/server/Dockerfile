FROM php:7.3-apache

RUN docker-php-ext-install \
    pdo_mysql \
    && a2enmod rewrite \
    && apt-get update \
    && apt-get install \
        apt-utils \
        libcurl3 \
        libcurl3-dev \
        build-essential \
        vim \
        software-properties-common \
        gnupg \
        gnupg2 \
        gnupg1 \
        nodejs yarn -y \
        && curl -sL https://deb.nodesource.com/setup_11.x | bash - \
        && apt-get install npm
