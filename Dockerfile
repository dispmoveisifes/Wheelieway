# Use the official PHP image as the base image
FROM php:7.4-apache

# Copy the application files into the container
COPY . /var/www/html

# Set the working directory in the container
WORKDIR /var/www/html

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y libpq-dev \
    libicu-dev \
    libzip-dev \
	&& docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    intl \
    zip \
    && a2enmod rewrite
	
RUN sed -E -i -e 's/max_execution_time = 30/max_execution_time = 120/' /etc/php.ini

# Expose port 80
EXPOSE 80

# Define the entry point for the container
CMD ["apache2-foreground"]