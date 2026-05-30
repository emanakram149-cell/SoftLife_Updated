FROM php:8.2-apache

# Enable Apache mod_rewrite for clean URLs (crucial for .htaccess)
RUN a2enmod rewrite

# "More than one MPM loaded" error ko fix karne ke liye baqi MPMs disable karein aur prefork ko force enable karein
RUN a2dismod mpm_event mpm_worker || true \
    && a2enmod mpm_prefork

# Install generic PHP extensions (PDO aur MySQL databases ke liye)
RUN docker-php-ext-install pdo pdo_mysql

# Copy all project files to container
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Apache config copy setup: .htaccess allow overrides enable karein
RUN echo '<Directory /var/www/html>\n  AllowOverride All\n  Options -Indexes\n  Require all granted\n</Directory>' \
    > /etc/apache2/conf-available/softlife.conf \
    && a2enconf softlife

EXPOSE 80

CMD ["apache2-foreground"]
