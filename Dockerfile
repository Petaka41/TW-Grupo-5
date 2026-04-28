FROM php:8.2-apache

# 1. Dependencias del sistema y librerías necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# 2. Extensiones de PHP para MySQL y manejo de archivos
RUN docker-php-ext-install pdo pdo_mysql mysqli zip

# 3. Instalamos Composer (indispensable en cualquier SaaS como INKIO)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Habilitamos mod_rewrite para que las rutas de Laravel funcionen
RUN a2enmod rewrite

# 5. Configuramos Apache para que su raíz sea la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. Permisos para que Apache pueda escribir en Laravel
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html