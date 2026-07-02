# WTI New Laravel Project

## Project Setup

1. Install PHP dependencies

```bash
composer install
```

2. Copy environment file

```bash
cp .env.example .env
```

3. Generate application key

```bash
php artisan key:generate
```

4. Configure `.env`

- Set `APP_NAME`, `APP_URL`, `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- Configure mail and queue settings if needed

5. Run database migrations

```bash
php artisan migrate
```

6. Install frontend dependencies

```bash
npm install
```

7. Start local development

```bash
npm run dev
```

8. Open the app in your browser

- Visit `http://127.0.0.1:5173` or `http://127.0.0.1:8000` depending on Vite and Laravel server setup.

## Common Development Commands

- Run backend server only:

```bash
php artisan serve
```

- Run frontend only:

```bash
npm run dev
```

- Publish pagination views for customization:

```bash
php artisan vendor:publish --tag=laravel-pagination
```

- Link public storage for uploaded files:

```bash
php artisan storage:link
```

- Run PHPUnit tests:

```bash
php artisan test
```

## Production / Go Live

Use these commands when deploying to production.

1. Install composer dependencies without dev packages

```bash
composer install --optimize-autoloader --no-dev
```

2. Install frontend dependencies and build assets

```bash
npm install
npm run build
```

3. Set the production environment

```bash
cp .env.example .env
```

4. Update `.env` for production

- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Set `APP_URL` to your live URL
- Configure production database and mail settings

5. Generate the application key if not already set

```bash
php artisan key:generate
```

6. Run migrations

```bash
php artisan migrate --force
```

7. Cache configuration and routes

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

8. Create storage symlink if it is not already created

```bash
php artisan storage:link
```

## Optional Production Maintenance

- Clear caches:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

- If you change Composer dependencies later:

```bash
composer update --optimize-autoloader --no-dev
php artisan boost:update --ansi
```

- If you change frontend assets later:

```bash
npm run build
```

## Notes

- This project uses Laravel 13 and Vite.
- If you run into Vite asset errors, rebuild assets with `npm run build`.
