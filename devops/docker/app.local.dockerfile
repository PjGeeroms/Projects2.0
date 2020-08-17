FROM php:7.4-fpm

#INSTALL DEPENDENCIES AND LIBRARIES
RUN apt-get update -y && apt-get install -y \
    apt-utils \
    curl \
    vim \
    nano \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    nginx \
    openssl \
    zip \
    unzip \
    nginx-extras \
    systemd \
    gnupg2 \
    openssh-client \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpq-dev \
    libssl-dev \
    libicu-dev \
    libonig-dev \
    libmagickwand-dev

# Install pecl PHP extensions
RUN pecl install \
    imagick-3.4.4 \
    xdebug-2.8.1

# Configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install PHP extensions
RUN docker-php-ext-install \
     bcmath \
     bz2 \
     exif \
     ftp \
     gettext \
     gd \
     iconv \
     intl \
     opcache \
     pdo \
     shmop \
     sockets \
     sysvmsg \
     sysvsem \
     sysvshm \
     zip \
     mysqli \
     pdo_mysql

# Enable PHP extensions
RUN docker-php-ext-enable \
    imagick \
    xdebug

#INSTALL NGINX
RUN systemctl enable nginx

#INSTALL COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY devops/nginx/nginx.conf /etc/nginx/sites-enabled/default

#CUSTOM PHP ini / Xdebug / PHP-fpm
COPY devops/php/custom.ini /usr/local/etc/php/conf.d
COPY devops/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY devops/php/zzz-docker.conf /usr/local/etc/php-fpm.d/zzz-docker.conf


# Create the storage directory and make it writeable by PHP
WORKDIR /var/www/project
RUN mkdir -p /var/www/project/cms/storage && \
    mkdir -p /var/www/project/cms/storage/runtime && \
    chown -R www-data:www-data /var/www/project/cms/storage

# Create the cpresources directory and make it writeable by PHP
RUN mkdir -p /var/www/project/cms/web/cpresources && \
    chown -R www-data:www-data /var/www/project/cms/web/cpresources

#RUN NGINX AND START PHP-FPM
ENTRYPOINT service nginx start && php-fpm