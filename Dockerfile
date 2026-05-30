FROM php:8.2-cli

RUN docker-php-ext-install pdo pdo_mysql

COPY . /app/

WORKDIR /app

EXPOSE 80

CMD ["apache2-foreground"]
