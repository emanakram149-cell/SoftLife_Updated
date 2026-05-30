FROM php:8.2-apache

# Install required PHP extensions for MySQL Database Connection
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module (For .htaccess rules to work)
RUN a2enmod rewrite

# Set working directory to standard Apache root
WORKDIR /var/www/html

# Copy all your PHP/CSS/JS project files directly to /var/www/html
COPY . /var/www/html

# Set the correct permissions for standard Apache user
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose standard port 80
EXPOSE 80

# Run standard Apache foreground command
CMD ["apache2-foreground"]
