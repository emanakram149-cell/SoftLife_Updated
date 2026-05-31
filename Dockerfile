FROM php:8.2-apache

# 1. System dependencies aur PHP Extensions
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. MPM fix — ONLY prefork, baaki sab force remove
RUN rm -f /etc/apache2/mods-enabled/mpm_event.conf \
          /etc/apache2/mods-enabled/mpm_event.load \
          /etc/apache2/mods-enabled/mpm_worker.conf \
          /etc/apache2/mods-enabled/mpm_worker.load \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.conf \
              /etc/apache2/mods-enabled/mpm_prefork.conf \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.load \
              /etc/apache2/mods-enabled/mpm_prefork.load

# 3. Rewrite enable + AllowOverride
RUN a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# 4. Working directory
WORKDIR /var/www/html

# 5. Files copy
COPY . .

# 6. Permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# 7. Port
EXPOSE 80

# 8. Start Apache
CMD ["apache2-foreground"]
