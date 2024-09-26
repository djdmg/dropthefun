# Utiliser l'image PHP-FPM avec Nginx
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
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    zip \
    intl \
    pdo_mysql \
    gd \
    opcache

RUN apt install -y libmemcached-dev zlib1g-dev libssl-dev
RUN yes '' | pecl install -f memcached-3.2.0 \
  && docker-php-ext-enable memcached

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier la configuration Nginx personnalisée
COPY nginx.conf /etc/nginx/nginx.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le code source de l'application Symfony
COPY . /var/www/html

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Définir les permissions sur le dossier var (si nécessaire)
RUN chown -R www-data:www-data /var/www/html/var

# Exposer les ports pour Nginx (HTTP) et PHP-FPM (FastCGI)
EXPOSE 80 9000

# Commande de démarrage pour lancer à la fois Nginx et PHP-FPM
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
