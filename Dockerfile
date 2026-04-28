FROM php:8.2-apache

# Instalamos solo lo estrictamente necesario
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && rm -rf /var/lib/apt/lists/*

# Extensiones para comunicación con la BD
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar rewrite para URLs amigables (importante para un SAAS)
RUN a2enmod rewrite

# Ajuste de permisos para evitar problemas con volúmenes en Linux
RUN chown -x /var/www/html
