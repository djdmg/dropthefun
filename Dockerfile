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

# Créer un répertoire temporaire pour copier le code source
WORKDIR /var/www/_temp_html
COPY . /var/www/_temp_html

# Installer les dépendances PHP dans le répertoire temporaire
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Définir les permissions sur le dossier var
RUN chown -R www-data:www-data /var/www/_temp_html/var

# Copier le script d'entrée
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Exposer les ports pour Nginx (HTTP) et PHP-FPM (FastCGI)
EXPOSE 80 9000

# Utiliser le script d'entrée pour démarrer le conteneur
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Vérifié si les fichiers sont bien copié
RUN ls -la /var/www/_temp_html

