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

### 3. Install/Update Dependencies
```bash
# Composer dependencies (production)
composer install --no-dev --optimize-autoloader

# NPM dependencies
npm ci --production
```

### 4. Build Assets
```bash
npm run build
```

### 5. Run Database Migrations
```bash
php artisan migrate --force
```

### 6. Clear and Cache Configuration
```bash
php artisan config:clear
php artisan config:cache
```

### 7. Clear and Cache Routes
```bash
php artisan route:clear
php artisan route:cache
```

### 8. Clear and Cache Views
```bash
php artisan view:clear
php artisan view:cache
```

### 9. Clear Application Cache
```bash
php artisan cache:clear
```

### 10. Optimize Application
```bash
php artisan optimize
```

### 11. Set Permissions
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 12. Create Storage Link (if needed)
```bash
php artisan storage:link
```

## One-Line Deployment Command

You can combine all commands into one line:

```bash
cd /path/to/your/project && \
git pull origin main && \
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

## Notes

- Replace `/path/to/your/project` with your actual project path
- Replace `www-data` with your web server user (common: `www-data`, `nginx`, `apache`)
- The `--force` flag on migrations is needed in production
- Use `--no-dev` for Composer to skip development dependencies
- Use `npm ci` instead of `npm install` for faster, reliable builds in production
