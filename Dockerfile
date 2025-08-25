# Usa la imagen base de PHP con Apache (actualizado a PHP 8.2 para Laravel 11)
FROM php:8.2-apache

# Instala dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    libzip-dev \
    libssl-dev \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml zip

# Instala la extensión de MongoDB (opcional, descomenta si la necesitas)
# RUN pecl install mongodb && docker-php-ext-enable mongodb

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de dependencias primero para aprovechar el cache de Docker
COPY composer.json composer.lock package.json ./

# Instala las dependencias de Composer
RUN composer install --no-dev --no-scripts --no-autoloader

# Copia el resto de los archivos del proyecto
COPY . .

# Genera el autoloader optimizado
RUN composer dump-autoload --optimize

# Ajusta los permisos de los archivos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Copia la configuración de Apache
COPY default.conf /etc/apache2/sites-available/000-default.conf

# Habilita el módulo rewrite de Apache
RUN a2enmod rewrite

# Crea el archivo .env si no existe (para entornos de desarrollo)
RUN if [ ! -f .env ]; then cp .env.example .env 2>/dev/null || echo "No .env.example found"; fi

# Comando para iniciar Apache
CMD ["apache2-foreground"]