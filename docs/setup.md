# Setup Project

1. Clone repo
2. Jalankan `composer install`
3. Copy `.env.example` ke `.env`
4. Jalankan `php artisan key:generate`
5. Setting DB di `.env`
6. Jalankan:
```bash
php artisan migrate:fresh --seed
php artisan serve
