FROM php:8.2-apache

# 1. Install required system packages and PHP extensions for MySQL database
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Set working directory to standard Apache document root
WORKDIR /var/www/html

# 3. Copy all repository files directly into the container
COPY . .

# 4. Set the correct permissions so Apache can read and execute the PHP files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# 5. Enable Apache Rewrite Module (for clean URLs and redirects)
RUN a2enmod rewrite

# 6. Expose default Web port
EXPOSE 80

# 7. Start standard official Apache server in the foreground
CMD ["apache2-foreground"]
