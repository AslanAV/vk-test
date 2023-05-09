FROM php:8.1-fpm
RUN apt-get update && apt-get install -y \
		build-essential \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libzip-dev \
        locales \
        zip \
        sqlite3 \
        jpegoptim optipng pngquant gifsicle \
        unzip \
        curl \
        libpq-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer/ | php -- install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#Install Extensions
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

WORKDIR /var/www
CMD ["php-fpm"]
