#!/bin/bash
set -e

echo "Starting PHP-FPM..."
php-fpm8.2 -D

echo "Starting Nginx..."
nginx -g 'daemon off;'
