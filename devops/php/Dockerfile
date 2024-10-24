FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    vim \
    nginx

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs

RUN npm install -g apidoc

RUN curl -sS https://getcomposer.org/installer | php -- --version=2.2.24 --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY . /var/www

RUN chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
