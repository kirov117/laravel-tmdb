# laravel-tmdb

### Deployment steps

1. Create a MySQL database & user
2. Copy environment file: `cp .env.example .env` and edit relevant database variables, as well as `TMDB_KEY`
3. Generate encryption key: `php artisan key:generate`
4. Run database migrations: `php artisan migrate`
5. Install Composer dependencies: `composer update`
6. Install Bower dependencies: `bower update`
7. Populate database with TMDB information: `php artisan tmdb:populate`

** Finally: `php artisan serve` and access http://127.0.0.1:8000