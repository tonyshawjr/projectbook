# Projectbook Deployment Instructions

## Quick Setup for projectbook.illbedev.com

### Step 1: Database Setup
1. Create a MySQL database in cPanel
2. Import these SQL files in order:
   - `database/schema.sql` (creates tables)
   - `database/seed.sql` (adds test data)

### Step 2: Update Configuration
1. Edit `config/config.php` with your database credentials:
```php
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_database_user');
define('DB_PASS', 'your_database_password');
```

### Step 3: Fix File Structure (Choose One)

#### Option A: Move public files to root (Easiest)
```bash
# Move these files from /public/ to root:
mv public/index.php index.php
mv public/.htaccess .htaccess
mv public/assets assets

# Then edit index.php line 14-18:
define('ROOT_PATH', __DIR__);  // Changed from dirname(__DIR__)
```

#### Option B: Set document root (Better if possible)
In cPanel, set your domain's document root to: `/public`

### Step 4: Set Permissions
```bash
chmod 755 storage/
chmod 644 config/config.php
```

### Step 5: Test Login
- URL: https://projectbook.illbedev.com
- Email: `tony@example.com`
- Password: `password123`

## Troubleshooting

### Still getting 403?
- Check if .htaccess is uploaded (hidden files)
- Verify mod_rewrite is enabled
- Check file permissions

### Database connection failed?
- Verify credentials in config/config.php
- Check if database charset is utf8mb4

### White screen?
- Enable debug mode in config/config.php
- Check PHP error logs in cPanel