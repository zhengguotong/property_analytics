FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www/html

# RUN a2enmod rewrite

# Required for fixing an error while installing pdftk 
RUN mkdir /usr/share/man/man1/

# Install dependencies
RUN apt-get update && \
    apt-get install -y --no-install-recommends curl \
    libmemcached-dev \
    libz-dev \
    libjpeg-dev \
    libpng-dev \
    libssl-dev \
    libmcrypt-dev \
    less \
    nano \
    vim \
    cron \
    git \
    unzip \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    pdftk

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo_mysql \
    pcntl \
    zip


RUN docker-php-ext-install opcache

# Configure php.ini
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN sed -e 's/max_execution_time = 30/max_execution_time = 600/' -i "$PHP_INI_DIR/php.ini"
RUN sed -e 's/memory_limit = 128M/memory_limit = 512M/' -i "$PHP_INI_DIR/php.ini"

# Configure opcache.ini
COPY ./conf.d/opcache.ini /tmp
RUN mv /tmp/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Cron
COPY ./cron /etc/cron.d/cron
RUN chmod 0644 /etc/cron.d/cron
RUN crontab /etc/cron.d/cron

#install composer
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer 


# Add www user and www group
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
RUN chown -R www: /var/www/html

# Change current user to www
USER www
