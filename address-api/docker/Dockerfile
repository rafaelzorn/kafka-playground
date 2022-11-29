FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && ( \
        cd /tmp \
        && mkdir librdkafka \
        && cd librdkafka \
        && git clone https://github.com/edenhill/librdkafka.git . \
        && ./configure \
        && make \
        && make install \
        && rm -rf /tmp/librdkafka \
    ) \
    && rm -r /var/lib/apt/lists/* \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka

RUN chmod -R 755 /var/www/html && chown -R www-data:www-data /var/www/html
