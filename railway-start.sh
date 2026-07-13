#!/bin/sh
set -e

echo ">>> [railway-start] Iniciando SGA Divino Salvador..."

composer dump-autoload --optimize --no-interaction --no-scripts || true
php artisan package:discover --ansi || true

php artisan db:import-schema || true

php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

php artisan storage:link || true

: "${PORT:=8080}"
echo ">>> [railway-start] Servidor escuchando en 0.0.0.0:${PORT}"
exec php -S 0.0.0.0:${PORT} -t public
