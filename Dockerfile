#####################
#                   #
# BUILDER CONTAINER #
#                   #
#####################

FROM php:7.0-cli as builder

COPY . ./dist

WORKDIR ./dist

RUN curl -sS https://getcomposer.org/composer.phar -o ../composer.phar \
    && apt-get update \
    && apt-get install -y git zip unzip zlib1g-dev \
    && docker-php-ext-install zip \
    && php ../composer.phar install --no-dev --prefer-dist

####################
#                  #
# SERVER CONTAINER #
#                  #
####################

FROM php:7.2-apache

COPY --from=builder ./dist /var/www/html

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && docker-php-ext-install pdo pdo_mysql \
    && cd $APACHE_DOCUMENT_ROOT/.. \
    && php artisan migrate --seed --force