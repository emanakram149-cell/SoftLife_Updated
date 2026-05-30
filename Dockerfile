FROM php:8.2-apache

# System dependencies aur PHP extension install karein
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer load karein
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Custom code copy karein
COPY . .

# Correct folder permissions set karein
RUN mkdir -p /var/www/html/web/app \
 && chown -R www-data:www-data /var/www/html/web/app \
 && chmod -R 775 /var/www/html/web/app

# Dependencies clean-load karein
RUN composer install --no-dev --optimize-autoloader

ENV APACHE_DOCUMENT_ROOT /var/www/html/web

# Apache configuration files update karein
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf && \
    sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

# ENTRYPOINT script copy aur configuration
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Agar entrypoint file Windows par edit hui thi, to use automatically Linux standard (LF) mein convert karein
RUN sed -i -e 's/\r$//' /entrypoint.sh

EXPOSE 80

# Custom entrypoint trigger karein
ENTRYPOINT ["/entrypoint.sh"]
