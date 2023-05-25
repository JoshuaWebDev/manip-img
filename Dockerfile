FROM php:7.4-apache

COPY ./src /usr/src/myapp

WORKDIR /usr/src/myapp

# CMD [ "php", "./index.php" ]