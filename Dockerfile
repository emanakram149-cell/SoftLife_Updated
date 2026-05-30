FROM php:8.2-apache

# 1. Zaroori PHP database extensions ko install karna
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Working directory set karna aur files copy karna
WORKDIR /var/www/html
COPY . .

# 3. Permissions fix karna takay Apache smoothly files read/write kar sakay
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# 4. entrypoint.sh ko container mein copying aur executable banana
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

# 5. Custom startup script run karna
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
