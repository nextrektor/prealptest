#!/bin/bash

LOG_FILE="/home/u912061746/domains/temanmajulogistics.com/laravel/prealptest/deploy.log"
TIMESTAMP=$(date +"%Y-%m-%d %H:%M:%S")

echo "[$TIMESTAMP] 🔄 Deployment started." >> "$LOG_FILE"

cd /home/u912061746/domains/temanmajulogistics.com/laravel/prealptest || {
    echo "[$TIMESTAMP] ❌ Failed to cd into project directory." >> "$LOG_FILE"
    exit 1
}

# Git reset
if git reset --hard HEAD >> "$LOG_FILE" 2>&1; then
    echo "[$TIMESTAMP] ✅ Git reset successful." >> "$LOG_FILE"
else
    echo "[$TIMESTAMP] ❌ Git reset failed." >> "$LOG_FILE"
fi

# Git clean
if git clean -df >> "$LOG_FILE" 2>&1; then
    echo "[$TIMESTAMP] ✅ Git clean successful." >> "$LOG_FILE"
else
    echo "[$TIMESTAMP] ❌ Git clean failed." >> "$LOG_FILE"
fi

# Git pull
if git pull origin main >> "$LOG_FILE" 2>&1; then
    echo "[$TIMESTAMP] ✅ Git pull successful." >> "$LOG_FILE"
else
    echo "[$TIMESTAMP] ❌ Git pull failed." >> "$LOG_FILE"
fi

# Set permissions
if chmod -R ug+rwx storage bootstrap/cache >> "$LOG_FILE" 2>&1; then
    echo "[$TIMESTAMP] ✅ Permissions set." >> "$LOG_FILE"
else
    echo "[$TIMESTAMP] ❌ Failed to set permissions." >> "$LOG_FILE"
fi

# Symlink storage
if [ ! -L "public/storage" ]; then
    if php artisan storage:link >> "$LOG_FILE" 2>&1; then
        echo "[$TIMESTAMP] ✅ Symlink created." >> "$LOG_FILE"
    else
        echo "[$TIMESTAMP] ❌ Failed to create symlink." >> "$LOG_FILE"
    fi
else
    echo "[$TIMESTAMP] ⏩ Symlink already exists." >> "$LOG_FILE"
fi

# Clear caches
if php artisan config:clear >> "$LOG_FILE" 2>&1 && \
   php artisan cache:clear >> "$LOG_FILE" 2>&1 && \
   php artisan view:clear >> "$LOG_FILE" 2>&1 && \
   php artisan route:clear >> "$LOG_FILE" 2>&1; then
    echo "[$TIMESTAMP] ✅ Cache cleared." >> "$LOG_FILE"
else
    echo "[$TIMESTAMP] ❌ Cache clear failed." >> "$LOG_FILE"
fi

# (Optional) Safe migrate
#if php artisan migrate --force >> "$LOG_FILE" 2>&1; then
#    echo "[$TIMESTAMP] ✅ Migrations ran successfully." >> "$LOG_FILE"
#else
#    echo "[$TIMESTAMP] ❌ Migration failed." >> "$LOG_FILE"
#fi

echo "[$TIMESTAMP] ✅ Deployment finished." >> "$LOG_FILE"
echo "----------------------------" >> "$LOG_FILE"
