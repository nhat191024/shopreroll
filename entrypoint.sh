#!/bin/bash

# Đảm bảo thư mục framework cache tồn tại
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}

chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap
chmod -R 775 /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap
chown -R www-data:www-data /var/www/html/bootstrap/cache

php artisan optimize:clear

exec "$@"
