#!/bin/bash

# Đảm bảo thư mục log tồn tại và có quyền ghi
mkdir -p /var/www/html/storage/logs
touch /var/www/html/storage/logs/laravel.log
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache

exec "$@"
