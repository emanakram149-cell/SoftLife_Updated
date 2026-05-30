FROM php:8.2-apache

# 1. System dependencies aur PHP Extensions install karein (Composer aur DB ke liye)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Railway par "More than one MPM loaded" error ko fix karein
RUN a2dismod mpm_event || true && \
    a2dismod mpm_worker || true && \
    a2enmod mpm_prefork || true

# 3. Apache rewrite module aur .htaccess permission enable karein (500 error fix karne ke liye)
RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# 4. Working directory set karein (Standard location)
WORKDIR /var/www/html

# 5. Apni sari files container mein copy karein
COPY . .

# 6. Correct folder permissions set karein taake Apache files ko read/write kar sake
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# 7. Port 80 expose karein (Railway automatically isko map kar dega)
EXPOSE 80

# 8. Apache server ko start karein (Bina kisi entrypoint.sh ke)
CMD ["apache2-foreground"]
