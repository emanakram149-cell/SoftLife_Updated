FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Saari files copy karein
COPY . .

# ERROR 1 FIX: Pure project ki ownership change karein jo actual mein exist karta hai
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html

# ERROR 2 FIX: Composer plugins ko root par run karne ki permission dein
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader

# DOCUMENT ROOT FIX: Aapki index.php root par hai, isliye document root sahi set karein
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf && \
    sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN echo "upload_max_filesize = 1024M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 1024M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 1536M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 600" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_input_time = 600" >> /usr/local/etc/php/conf.d/uploads.ini

RUN a2enmod rewrite

EXPOSE 80

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
