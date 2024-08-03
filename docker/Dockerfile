FROM php:8.2-apache

RUN apt-get update

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions pdo pdo_mysql mbstring pdo_mysql zip exif pcntl gd


#previous code
# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions xdebug

COPY docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/

RUN apt-get install -y curl
RUN apt-get update && apt-get install -y git
RUN apt-get update && apt-get install -y unzip

RUN cd ~
RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -

RUN apt -y install nodejs

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt install -y yarn

COPY ./virtualhost.conf /etc/apache2/sites-available/
COPY ./php.ini /usr/local/lib/
COPY ./php.ini /usr/local/etc/php/

RUN a2dissite 000-default.conf; \
    a2enmod headers; \
    a2enmod rewrite; \
    a2ensite virtualhost.conf; \
    service apache2 restart;
