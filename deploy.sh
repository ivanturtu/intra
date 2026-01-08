#!/bin/bash

# Laravel Post-Deployment Script
# Run this script via SSH after deploying your application

set -e  # Exit on error

# Configuration - Update these variables
PROJECT_PATH="/path/to/your/project"  # Update with your server path
PHP_VERSION="php8.2"  # Update with your PHP version

echo "🚀 Starting Laravel deployment..."

# Navigate to project directory
cd $PROJECT_PATH

# Pull latest code from GitHub (if using git)
echo "📥 Pulling latest code..."
git pull origin main

# Install/Update Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# Install/Update NPM dependencies
echo "📦 Installing NPM dependencies..."
npm ci --production

# Build assets
echo "🏗️  Building assets..."
npm run build

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Clear and cache configuration
echo "⚙️  Optimizing configuration..."
php artisan config:clear
php artisan config:cache

# Clear and cache routes
echo "🛣️  Optimizing routes..."
php artisan route:clear
php artisan route:cache

# Clear and cache views
echo "👁️  Optimizing views..."
php artisan view:clear
php artisan view:cache

# Clear application cache
echo "🧹 Clearing application cache..."
php artisan cache:clear

# Optimize the application
echo "⚡ Optimizing application..."
php artisan optimize

# Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Create storage link if it doesn't exist
echo "🔗 Creating storage link..."
php artisan storage:link || true

echo "✅ Deployment completed successfully!"
