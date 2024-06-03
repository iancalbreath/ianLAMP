FROM php:7.4-apache

COPY html/ /var/www/html/
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

RUN docker-php-ext-install mysqli && \
    a2enmod rewrite

