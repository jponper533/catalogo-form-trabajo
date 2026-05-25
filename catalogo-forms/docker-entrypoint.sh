#!/bin/sh

echo "Esperando a MySQL..."

mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/logs

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache


php artisan key:generate --force

php artisan migrate:fresh --force

php artisan optimize:clear

apache2-foreground