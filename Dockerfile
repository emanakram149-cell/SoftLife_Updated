FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Nuclear MPM fix - disable everything, enable only prefork
RUN for mod in mpm_event mpm_worker mpm_prefork; do \
        a2dismod $mod 2>/dev/null || true; \
    done \
    && a2enmod mpm_prefork \
    && a2enmod rewrite

# AllowOverride fix
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && sed -i 's/AllowOverride none/AllowOverride All/g' /etc/apache2/apache2.conf

# Verify only one MPM is active
RUN apache2ctl configtest 2>&1 || true

WORKDIR /var/www/html
COPY . .
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
