FROM php:8.2-apache

# 1. Database connection ke liye zaroori PHP extensions install karein
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 2. Apache directory set karein
WORKDIR /var/www/html

# 3. Apne project ka saara code copy karein
COPY . .

# 4. Standard permission set karein
RUN chown -R www-data:www-data /var/www/html

# 5. Apache rewrite rule enable karein (required for .htaccess)
RUN a2enmod rewrite

# Port expose karein
EXPOSE 80

# 6. CRITICAL FIX to prevent "More than one MPM loaded" error on Railway
# Yeh command dynamically conflicting mpm_event ko disable karegi aur mpm_prefork ko enable karegi
CMD expr "`a2query -m`" : ".*mpm_prefork.*" || (a2dismod mpm_event && a2enmod mpm_prefork) && apache2-foreground
