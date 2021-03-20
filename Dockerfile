FROM php:8.0.3-fpm

RUN apt-get update \
    && apt-get install -y git

RUN git clone --depth=1 https://github.com/amphp/ext-fiber.git /usr/src/php/ext/fiber \
    && cd /usr/src/php/ext/fiber \
 	&& docker-php-source extract \
 	&& docker-php-ext-install fiber \
 	&& make test \
 	&& docker-php-source delete

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

