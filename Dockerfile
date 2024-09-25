FROM php:8.3-fpm

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    memcached \
    php-memcached \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    zip \
    intl \
    pdo_mysql \
    gd \
    opcache



# Vérifier que l'extension Memcached est bien installée
RUN php -m | grep memcached


# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le code source
COPY . /var/www/html

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Définir les permissions (si nécessaire)
RUN chown -R www-data:www-data /var/www/html/var

# Exposer le port si nécessaire
EXPOSE 9000

# Commande de démarrage
CMD ["php-fpm"]
