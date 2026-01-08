# Deployment Guide - SSH Commands

This document contains the SSH commands to run after deploying your Laravel application to a server.

## Quick Deployment Commands

After SSH'ing into your server, run these commands in order:

### 1. Navigate to Project Directory
```bash
cd /path/to/your/project
```

### 2. Pull Latest Code (if using Git)
```bash
git pull origin main
```

### 3. Set Node Version (if using nodenv)
```bash
# Set Node version from .node-version file
nodenv install -s 2>/dev/null || true
nodenv local 20
eval "$(nodenv init -)"

# Verify Node and npm are available
node -v
npm -v
```

### 4. Install/Update Dependencies
```bash
# Composer dependencies (production)
composer install --no-dev --optimize-autoloader

# NPM dependencies
npm ci --production
```

### 5. Build Assets
```bash
npm run build
```

### 6. Run Database Migrations
```bash
php artisan migrate --force
```

### 7. Clear and Cache Configuration
```bash
php artisan config:clear
php artisan config:cache
```

### 8. Clear and Cache Routes
```bash
php artisan route:clear
php artisan route:cache
```

### 9. Clear and Cache Views
```bash
php artisan view:clear
php artisan view:cache
```

### 10. Clear Application Cache
```bash
php artisan cache:clear
```

### 11. Optimize Application
```bash
php artisan optimize
```

### 12. Set Permissions
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 13. Create Storage Link (if needed)
```bash
php artisan storage:link
```

## One-Line Deployment Command

You can combine all commands into one line:

```bash
cd /path/to/your/project && \
git pull origin main && \
nodenv local 20 && eval "$(nodenv init -)" && \
composer install --no-dev --optimize-autoloader && \
npm ci --production && \
npm run build && \
php artisan migrate --force && \
php artisan config:clear && \
php artisan config:cache && \
php artisan route:clear && \
php artisan route:cache && \
php artisan view:clear && \
php artisan view:cache && \
php artisan cache:clear && \
php artisan optimize && \
chmod -R 755 storage bootstrap/cache && \
chown -R www-data:www-data storage bootstrap/cache && \
php artisan storage:link || true
```

## Using the Deployment Script

1. Make the script executable:
```bash
chmod +x deploy.sh
```

2. Update the `PROJECT_PATH` variable in `deploy.sh` with your server path

3. Run the script:
```bash
./deploy.sh
```

Or run it directly via SSH:
```bash
bash deploy.sh
```

## Additional Commands (if needed)

### Restart PHP-FPM (if using PHP-FPM)
```bash
sudo service php8.2-fpm restart
# or
sudo systemctl restart php8.2-fpm
```

### Restart Web Server
```bash
# For Nginx
sudo service nginx restart
# or
sudo systemctl restart nginx

# For Apache
sudo service apache2 restart
# or
sudo systemctl restart apache2
```

### Check Application Status
```bash
php artisan about
```

### View Logs
```bash
tail -f storage/logs/laravel.log
```

## Environment Variables

Make sure your `.env` file is properly configured on the server with:
- `APP_ENV=production`
- `APP_DEBUG=false`
- Database credentials
- Other necessary environment variables

## Troubleshooting

### Composer Vendor Directory Corruption Error

If you encounter errors like:
```
Script Illuminate\Foundation\ComposerScripts::prePackageUninstall handling the pre-package-uninstall event terminated with an exception
Class "SebastianBergmann\Version" not found
```

This indicates a corrupted or incomplete `vendor` directory. Fix it with:

**Option 1: Use the fix script**
```bash
cd /var/www/vhosts/turturiello.com/intra.turturiello.com
bash fix-composer.sh
```

**Option 2: Manual fix**
```bash
cd /var/www/vhosts/turturiello.com/intra.turturiello.com

# Backup and remove corrupted vendor directory
mv vendor vendor.backup.$(date +%Y%m%d_%H%M%S)
# or simply remove it:
rm -rf vendor

# Clear composer cache
composer clear-cache

# Fresh install
composer install --no-dev --optimize-autoloader --no-interaction
```

**Option 3: Quick fix (if vendor is partially corrupted)**
```bash
cd /var/www/vhosts/turturiello.com/intra.turturiello.com
composer clear-cache
rm -rf vendor
composer install --no-dev --optimize-autoloader --no-interaction
```

### Permission Errors

If you get permission errors:
```bash
# Fix storage and cache permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Or if using Plesk:
chmod -R 775 storage bootstrap/cache
chown -R psacln:psacln storage bootstrap/cache
```

### Node/npm Command Not Found (nodenv)

If you get `nodenv: npm: command not found`:

**Quick Fix:**
```bash
cd /var/www/vhosts/turturiello.com/intra.turturiello.com

# Set Node version (20 or 21)
nodenv local 20
# or
nodenv local 21

# Initialize nodenv in current shell
eval "$(nodenv init -)"

# Verify npm is now available
npm -v
```

**Permanent Fix:**
The `.node-version` file in the project root will automatically set the Node version. After pulling the code:
```bash
cd /var/www/vhosts/turturiello.com/intra.turturiello.com
git pull origin main
nodenv install -s  # Install Node version if not already installed
nodenv local      # This reads .node-version file
eval "$(nodenv init -)"
```

**For SSH sessions, add to your shell profile (~/.bashrc or ~/.zshrc):**
```bash
eval "$(nodenv init -)"
```

### 403 Forbidden Error

If you see "403 Forbidden" error:

**Step 1: Create .env file (if missing)**
```bash
cd ~/intra.turturiello.com
cp .env.example .env
php artisan key:generate
```

**Step 2: Fix permissions**
```bash
cd ~/intra.turturiello.com

# Fix storage and cache permissions
chmod -R 775 storage bootstrap/cache
chmod -R 755 public

# For Plesk servers:
chown -R psacln:psacln storage bootstrap/cache public

# For standard servers:
chown -R www-data:www-data storage bootstrap/cache public
```

**Step 3: Verify document root points to /public**
```bash
# Check if public/index.php exists
ls -la ~/intra.turturiello.com/public/index.php

# Verify public directory permissions
ls -ld ~/intra.turturiello.com/public
```

**Step 4: Clear Laravel caches**
```bash
cd ~/intra.turturiello.com
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
```

**Step 5: Check web server configuration**
- For Plesk: Document root should be: `~/intra.turturiello.com/public`
- For Apache/Nginx: Document root should point to `/path/to/intra.turturiello.com/public`

**Quick fix (all steps combined):**
```bash
cd ~/intra.turturiello.com && \
cp .env.example .env && \
php artisan key:generate && \
chmod -R 775 storage bootstrap/cache && \
chmod -R 755 public && \
chown -R psacln:psacln storage bootstrap/cache public && \
php artisan config:clear && \
php artisan cache:clear && \
php artisan config:cache
```

### PHP Version Issues

Make sure you're using the correct PHP version:
```bash
# Check PHP version
php -v

# Use specific PHP version (if multiple installed)
/opt/plesk/php/8.2/bin/php composer install --no-dev --optimize-autoloader
```

## Notes

- Replace `/path/to/your/project` with your actual project path
- Replace `www-data` with your web server user (common: `www-data`, `nginx`, `apache`, `psacln` for Plesk)
- The `--force` flag on migrations is needed in production
- Use `--no-dev` for Composer to skip development dependencies
- Use `npm ci` instead of `npm install` for faster, reliable builds in production
- For Plesk servers, use `/opt/plesk/php/8.2/bin/php` instead of `php` if needed
