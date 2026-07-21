FROM php:8.2-fpm

# Dependencias del sistema necesarias para compilar extensiones PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Extensiones PHP que Laravel 11 requiere (pdo_mysql para conectar con MySQL 8)
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Composer (gestor de dependencias de PHP) copiado desde la imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Permisos para que Laravel pueda escribir en storage y cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Instala las dependencias de producción/desarrollo definidas en composer.json
RUN composer install --no-interaction --optimize-autoloader || true

EXPOSE 9000
CMD ["php-fpm"]
