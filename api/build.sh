#!/usr/bin/env bash
# Build script para Laravel en Render

echo "🚀 Iniciando build de Laravel..."

# Instalar dependencias de Composer
echo "📦 Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Limpiar caches
echo "🧹 Limpiando caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimizar aplicación para producción
echo "⚡ Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar migraciones (comentado por defecto - descomentar si DB está lista)
# echo "🗄️ Ejecutando migraciones..."
# php artisan migrate --force

echo "✅ Build completado exitosamente!"
