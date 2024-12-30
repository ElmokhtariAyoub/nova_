FROM php:8.2-apache


RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip


COPY . /var/www/html/


RUN chown -R www-data:www-data /var/www/html



EXPOSE 80

CMD ["apache2-foreground"]