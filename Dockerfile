FROM php:8.2-apache

# 1. Conflicting MPM modules ko disable karein aur mpm_prefork ko force enable karein
RUN a2dismod mpm_event mpm_worker || true \
    && a2enmod mpm_prefork

# 2. Apache mod_rewrite enable karein (.htaccess support ke liye)
RUN a2enmod rewrite

# 3. PHP extensions install karein
RUN docker-php-ext-install pdo pdo_mysql

# 4. Project files copy karein
COPY . /var/www/html/

# 5. Correct file permissions set karein
RUN chown -R www-data:www-data /var/www/html

# 6. Apache configuration (Allow .htaccess overrides)
RUN echo '<Directory /var/www/html>\n  AllowOverride All\n  Options -Indexes\n  Require all granted\n</Directory>' \
    > /etc/apache2/conf-available/softlife.conf \
    && a2enconf softlife

EXPOSE 80

CMD ["apache2-foreground"]
