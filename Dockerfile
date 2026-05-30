FROM php:8.2-apache

RUN a2enmod rewrite headers

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

RUN echo '<Directory /var/www/html>
    AllowOverride All
    Options -Indexes
    Require all granted
</Directory>' \
    > /etc/apache2/conf-available/softlife.conf \
    && a2enconf softlife

EXPOSE 80

CMD ["apache2-foreground"]
