FROM php:7.4-fpm-alpine

# Maintainer of image
LABEL maintainer="Janosch Kocsis <jk@coloso.de>"

# Instruction used To get the latest list of available packages
RUN apk add --update \
    make \
    curl \
    nodejs \
    yarn

#Installing Mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Fetching composer and installing it
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    ln -s $(composer config --global home) /root/composer

# Definition of Environment variable
ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

ADD php.ini /etc/php/conf.d/
ADD php.ini /etc/php/cli/conf.d/
ADD php-fpm.conf /etc/php/php-fpm.d/
#ADD xdebug.ini  /etc/php/conf.d/

WORKDIR /var/www/symfony

# Indicates the ports on which a container listens for connections.
EXPOSE 9000

# Command to run container
CMD ["php-fpm", "-F"]