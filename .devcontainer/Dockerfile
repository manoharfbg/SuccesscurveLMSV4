FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
        git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev libcurl4-openssl-dev \
        default-mysql-client \
    && docker-php-ext-install \
        pdo_mysql mysqli gd mbstring zip bcmath xml curl intl \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Node.js (for package.json / webpack.mix.js asset builds, optional)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /workspace
