#!/bin/sh

set -e

echo "🚀 Starting Laravel 12 + Filament 4 deployment..."

cd /var/www/html

# Instala dependências do Composer (otimizado para produção)
echo "📦 Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

# Gera chave da aplicação se não existir
# if ! grep -q "APP_KEY=base64:" .env; then
#     echo "🔑 Generating application key..."
#     php artisan key:generate --force
# fi

# Instala dependências do NPM e faz build do frontend
echo "🎨 Installing NPM dependencies (including dev for build)..."
npm ci

echo "🏗️  Building frontend assets..."
npm run build

echo "🧹 Cleaning up dev dependencies..."
npm prune --production

# Aguarda o MySQL estar disponível
echo "⏳ Waiting for MySQL..."
DB_HOST="${DB_HOST:-mysql}"
DB_PORT="${DB_PORT:-3306}"
DB_USERNAME="${DB_USERNAME:-root}"
DB_PASSWORD="${DB_PASSWORD:-}"

# if [ -z "$DB_PASSWORD" ]; then
#     until mysqladmin ping -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" --silent > /dev/null 2>&1; do
#         echo "MySQL is unavailable - sleeping"
#         sleep 2
#     done
# else
#     until mysqladmin ping -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" -p"$DB_PASSWORD" --silent > /dev/null 2>&1; do
#         echo "MySQL is unavailable - sleeping"
#         sleep 2
#     done
# fi
# echo "✅ MySQL is up!"

# Executa migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force --no-interaction

# Executa seeders se a variável de ambiente estiver definida
if [ "${RUN_SEEDERS:-false}" = "true" ]; then
    echo "🌱 Running database seeders..."
    php artisan db:seed --force --no-interaction
fi

# Otimiza a aplicação
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan filament:optimize

# Cria link simbólico do storage
echo "🔗 Creating storage link..."
php artisan storage:link --force

# Ajusta permissões finais
echo "🔒 Setting final permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "✅ Deployment completed successfully!"

# Inicia PHP-FPM e Nginx
echo "🌐 Starting web server..."
php-fpm -D && nginx -g 'daemon off;'