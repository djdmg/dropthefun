#!/bin/sh

# Copier les fichiers du répertoire temporaire vers le répertoire monté
cp -R /var/www/_temp_html/* /var/www/html/

# Démarrer PHP-FPM et Nginx
php-fpm -D && nginx -g 'daemon off;'
