# Use official PHP 8.2 image with Apache
FROM php:8.2-apache

# Update the package manager and install required extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy application files to the web root
COPY . /var/www/html/

# Ensure proper permissions for the web server
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose HTTP port
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
