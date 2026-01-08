#!/bin/bash

# Fix Composer Vendor Directory Corruption
# Run this script via SSH when you encounter composer errors

set -e  # Exit on error

# Configuration - Update these variables
PROJECT_PATH="/var/www/vhosts/turturiello.com/intra.turturiello.com"  # Update with your server path

echo "🔧 Fixing corrupted Composer vendor directory..."

# Navigate to project directory
cd $PROJECT_PATH

# Backup current vendor directory (optional)
if [ -d "vendor" ]; then
    echo "📦 Backing up vendor directory..."
    mv vendor vendor.backup.$(date +%Y%m%d_%H%M%S) || true
fi

# Remove composer.lock if you want a fresh install (optional - uncomment if needed)
# echo "🗑️  Removing composer.lock..."
# rm -f composer.lock

# Clear composer cache
echo "🧹 Clearing Composer cache..."
composer clear-cache

# Install dependencies fresh
echo "📦 Installing Composer dependencies fresh..."
composer install --no-dev --optimize-autoloader --no-interaction

# Verify installation
echo "✅ Verifying installation..."
php artisan --version

echo "✅ Composer fix completed successfully!"
echo "💡 You can now remove the backup directory if everything works: rm -rf vendor.backup.*"
