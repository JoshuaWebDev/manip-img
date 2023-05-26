FROM php:7.4-apache

# Atualiza as bibliotecas do sistema e instala as dependências do PHP
#RUN apt-get update && apt-get install -y vim curl \
#    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
#    && docker-php-source extract \
#    && docker-php-ext-configure gd --with-freetype --with-jpeg \
#    && docker-php-ext-install -j$(nproc) gd \
#    && docker-php-source delete

# Instala o Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

COPY . /usr/src/manip-img

WORKDIR /usr/src/manip-img

# CMD [ "php", "./index.php" ]