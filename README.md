composer install
sail up -d (./vendor/bin/sail up -d)
sail exec app php artisan key:generate
sail exec app php artisan migrate
sail exec app php artisan db:seed
sail exec app chmod -R 777 .
sail exec app php artisan db:seed --class=UserSeeder (generate fake user)
