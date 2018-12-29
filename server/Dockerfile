FROM php:7.3-apache

RUN docker-php-ext-install \
    pdo_mysql \
    && a2enmod rewrite \
    && apt-get update -y \
    && apt-get install vim -y
