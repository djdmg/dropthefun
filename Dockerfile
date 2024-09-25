# Utiliser PHP 8.3 CLI
FROM php:8.3-cli

# Installer les dépendances pour MariaDB
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libmariadb-dev \
    && docker-php-ext-install pdo pdo_mysql

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers composer pour installer les dépendances
COPY composer.json composer.lock /app/

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Copier le reste du code source
COPY . /app

# Configurer les variables d'environnement
ENV APP_ENV=prod
ENV APP_DEBUG=0

# Définir la commande de démarrage pour consommer les messages échoués
CMD ["php", "bin/console", "messenger:consume", "failed", "--time-limit=0", "--memory-limit=128M", "--sleep=10", "-vv"]
