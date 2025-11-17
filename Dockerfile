FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

LABEL maintainer="Gusouza980 <gusouza980@gmail.com>"

LABEL description="Laravel 12 + Filament 4 + PostgreSQL Dockerfile"

# Instala dependências do sistema
RUN apk add --no-cache \
    zip \
    libzip-dev \
    libpng-dev \
    libpq-dev \
    icu-dev \
    npm \
    postgresql-client \
    nginx

# Instala extensões do PHP necessárias para Laravel 12 e Filament 4
RUN docker-php-ext-install \
    zip \
    gd \
    pdo_pgsql \
    pgsql \
    opcache \
    intl \
    bcmath

# Copia arquivos de configuração do frontend primeiro (para cache do Docker)
COPY ./package.json ./
COPY ./package-lock.json ./
COPY ./vite.config.js ./
COPY ./resources ./resources

# Copia o restante dos arquivos da aplicação
COPY . ./

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html \
    && rm -rf ./docker

# Copia arquivos de configuração do Docker
COPY ./docker/config/laravel-php.ini /usr/local/etc/php/conf.d/laravel-php.ini
COPY ./docker/config/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/config/site-nginx.conf /etc/nginx/http.d/default.conf

# Torna o entrypoint executável
RUN chmod +x ./docker-entrypoint.sh

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Ajusta permissões finais
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 storage bootstrap/cache

EXPOSE 80
USER root
CMD ["./docker-entrypoint.sh"]