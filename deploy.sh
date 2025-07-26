#!/bin/bash

cd /home/u912061746/domains/temanmajulogistics.com/laravel/prealptest || exit

# Reset the repo and pull latest changes
git reset --hard HEAD
git clean -df
git pull origin main

# Install dependencies if composer exists
#if [ -f "composer.json" ]; then
#  composer install --no-interaction --prefer-dist --optimize-autoloader
#fi

# Set permissions (safe version)
chmod -R ug+rwx storage bootstrap/cache

# Recreate symlink if missing
#if [ ! -L "public/storage" ]; then
#  php artisan storage:link
#fi

# Clear and cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# (Optional) Run migrations
# php artisan migrate --force
