#!/bin/bash
set -e

# Đảm bảo thư mục log tồn tại và có quyền ghi
mkdir -p /var/www/storage/logs
touch /var/www/storage/logs/laravel.log
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache

exec "$@"
