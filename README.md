# Kripto App

For running on local, clone the app & navigate to root folder.
Run the following steps:
1. run the command: mv .env.example .env
2. fill APP_URL, DB_DATABASE, DB_USERNAME and DB_PASSWORD data in the .env file
3. run the command: composer install
4. run the command: php artisan migrate:fresh --seed
5. (optional, if using Linux) run the command: php artisan serve
6. (optional, if want to use webocket feature) run the command: php artisan schedule:work
7. feel free to use the app
