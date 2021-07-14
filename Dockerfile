FROM php:7.4-apache
RUN docker-php-ext-install mysqli
COPY src/ /usr/src/demo
WORKDIR /usr/src/demo
CMD [ "php", "./index.php" ]