#!/bin/bash

# Change to project directory
cd /home/u912061746/domains/temanmajulogistics.com/laravel/prealptest || exit

# Pull from GitHub (make sure the repo is already cloned and configured)
git pull origin main

# Set correct permissions (optional, once)
chmod -R 775 storage bootstrap/cache

# Laravel commands
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# Optional: Run migrations if you're confident
# php artisan migrate --force


echo "✅ Deployment completed at $(date)"
