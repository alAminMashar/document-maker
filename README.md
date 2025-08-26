<!-- Add this to the .htaccess file in /public -->
<!-- 
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
-->


//For debugging Add the following to the top of the index.php file in public

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

<!-- Deployment Procedure Commands -->
Bismillah <3

composer install

npm install

npm run production/dev

composer dumpautoload

php artisan optimize:clear

php artisan queue:table

php artisan migrate:fresh --seed

php artisan permission:create-permission-routes

php artisan db:seed --class=UsersSeeder


<!-- For Deployment -->

<!-- Add the following to bootstrap app.php -->
$app->usePublicPath(base_path('/../public_html'));


<!-- Public/Index.php -->
require __DIR__.'/../<main_app_files>/vendor/autoload.php';

$app = require_once __DIR__.'/../<main_app_files>/bootstrap/app.php';


% //Run terminal command to work queues in the background and log changes
nohup php artisan queue:work --timeout=3300 --daemon >> storage/logs/queue-output.log &

//Running Cron Jobs in conjunction with Laravel Scheduler
/usr/local/bin/ea-php82 /home/eoztqayy/<app_folder>/ >> /dev/null 2>&1


//Kill all tasks in queue
for pid in $(ps -fe | grep artisan); do kill $pid; done


//Process Management Linux
Show Processes: ps -fe | grep artisan 
Kill Process By ID: kill 12345 (whatever number it is)

//After deploying new code run the following upon clearing cache
php artisan queue:restart


Run Consistent Queues Using Scheduler and Cron Jobs read more on the tutorial below.
https://talltips.novate.co.uk/laravel/using-queues-on-shared-hosting-with-laravel


Change the Logos, Login Page Background Image, Letterhead, Footer & Stamp Images

Bismillah. You are ready for your first demonstration

Setting Up Cron Jobs
/usr/local/bin/ea-php82 /home/eoztqayy/canon-app/artisan schedule:run
