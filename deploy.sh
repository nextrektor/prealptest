#!/bin/bash

# Define your Laravel project root directory
LARAVEL_PROJECT_ROOT="/home/u912061746/domains/temanmajulogistics.com/laravel/prealptest"

# Define the Git branch you want to deploy (usually 'main' or 'master')
GIT_BRANCH="main" # <--- IMPORTANT: Change if your main branch is different

echo "--- Deployment started at $(date) ---"

# Navigate to the Laravel project root
echo "Navigating to $LARAVEL_PROJECT_ROOT"
cd $LARAVEL_PROJECT_ROOT

# Check if directory change was successful
if [ $? -ne 0 ]; then
    echo "Error: Could not navigate to $LARAVEL_PROJECT_ROOT. Exiting."
    exit 1
fi

# Ensure we are on the correct branch and pull the latest changes
echo "Checking out branch $GIT_BRANCH and pulling latest changes..."
git checkout $GIT_BRANCH
git pull origin $GIT_BRANCH

# Check if git pull was successful
if [ $? -ne 0 ]; then
    echo "Error: Git pull failed. Please check repository access and branch name. Exiting."
    exit 1
fi

# Run Composer install/update to ensure all dependencies are met
# --no-dev: Skips development dependencies (good for production)
# --optimize-autoloader: Optimizes Composer's autoloader for faster loading
echo "Running Composer install..."
composer install --no-dev --optimize-autoloader

# Run database migrations
# --force: Essential for production to skip confirmation prompt
#echo "Running database migrations..."
#php artisan migrate --force

# Clear and cache configurations, routes, and views
# This step is crucial for performance and to ensure new changes are loaded
echo "Clearing and caching application configurations..."
php artisan optimize:clear # Clears all caches first
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Re-link storage (only if your storage link ever gets broken, otherwise optional)
# The first symlink you showed: storage/app/public to public/storage
# This command creates or refreshes that link.
echo "Re-linking storage (if necessary)..."
php artisan storage:link

echo "--- Deployment finished successfully! ---"
