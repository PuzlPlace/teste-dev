# Use an official PHP runtime as a parent image
FROM php:8.2-fpm-buster
# Set the working directory to /var/www/html
WORKDIR /var/www/
# Install any needed extensions
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            libmemcached-dev \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            libicu-dev \
            git \
            libxml2-dev \
            zip \
            libzip-dev \
            zlib1g-dev \
            unzip \
            libonig-dev; \
    rm -rf /var/lib/apt/lists/*

    # Install the PHP pdo_mysql extention
RUN docker-php-ext-install pdo_mysql; \
    # Install the PHP pdo_pgsql extention
    docker-php-ext-install pdo_pgsql; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    docker-php-ext-install gd; \
    # Install the PHP zip library
    docker-php-ext-configure zip; \
    docker-php-ext-install zip; \
    # Install the intl extension
    docker-php-ext-configure intl; \
    docker-php-ext-install intl

RUN  apt-get update && apt-get install -y curl \
libcurl4-gnutls-dev  && \
docker-php-ext-install curl

RUN docker-php-ext-install mbstring; \
docker-php-ext-install bcmath;  

RUN pecl install redis \
&& docker-php-ext-enable redis

# Copy files
COPY . /var/www/

CMD php artisan serve --host=0.0.0.0 --port 80
