FROM php:8.4-apache
RUN a2dismod mpm_event || true \
    && a2enmod mpm_prefork \
    && docker-php-ext-install mysqli \
    && a2enmod rewrite
COPY . /var/www/html/
EXPOSE 80