FROM php:8.1-apache
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN apt-get update && apt-get upgrade -y
COPY src/ /var/www/html/
EXPOSE 80