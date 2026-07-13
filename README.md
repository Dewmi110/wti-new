# WTI New

WTI New is a Laravel 13 tourism website with a Vite-powered frontend and an admin dashboard for managing tours, bookings, blogs, destinations, and site content.

## Tech Stack

- PHP 8.3+
- Laravel 13
- Vite
- Tailwind CSS
- MySQL-compatible database

## Project Highlights

- Frontend pages for tours, destinations, blogs, contact, and inquiries
- Admin authentication and management dashboard
- Tour, category, type, theme, booking, and content management modules
- Vite build pipeline for frontend assets

## Requirements

Before you start, make sure you have:

- PHP 8.3 or later
- Composer
- Node.js and npm
- A database server such as MySQL

## Local Setup

1. Install PHP dependencies

```bash
composer install
```

2. Create the environment file

```bash
copy .env.example .env
```

If you are using macOS or Linux, use:

```bash
cp .env.example .env
```

3. Generate the application key

```bash
php artisan key:generate
```

4. Configure your database settings in `.env`

Set the following values for your environment:

- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

5. Run database migrations

```bash
php artisan migrate
```

## Common Commands

- Run tests:

```bash
php artisan test
```

- Link storage for uploaded files:

```bash
php artisan storage:link
```

- Clear cached configuration:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## Admin Access

The admin area is available under:

```text
/login
```

After login, use the admin dashboard to manage content and bookings.

## Production Deployment

For production, use the following flow:

```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
php artisan key:generate
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

Set the appropriate production values in `.env`, including:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL`
- database and mail credentials

## Notes

- The project uses Laravel 13 and Vite.
- If frontend assets do not update correctly, run `npm run build` again.
- The public storage directory should be linked once during setup or deployment.
