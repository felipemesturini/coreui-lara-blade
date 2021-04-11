echo "*** Composer ****"
composer clear
composer dumpautoload

echo "*** Npm ****"
npm install

echo "*** artisan ****"
php artisan view:clear
php artisan cache:clear
php artisan route:clear
php artisan optimize:clear
php artisan migrate
