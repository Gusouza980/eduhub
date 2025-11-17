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

# Aguarda o PostgreSQL estar disponível
echo "⏳ Waiting for PostgreSQL..."
until pg_isready -h "${DB_HOST:-pgsql}" -p "${DB_PORT:-5432}" -U "${DB_USERNAME:-laravel}" > /dev/null 2>&1; do
    echo "PostgreSQL is unavailable - sleeping"
    sleep 2
done
echo "✅ PostgreSQL is up!"

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