<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | System Configurations
    |--------------------------------------------------------------------------
    |
    | These values will be used on various sections of the system
    |
    */

    //Suspend Use due to none payment change the below to false
    'suspended'     =>  false,

     //Currency
    'currency_short'    =>  'Ksh.',
    'currency_full'     =>  'Kenyan Shillings',

    //Approval & Disapproval Limits
    'approval_requirement'  =>  2,
    'disapproval_requirement'  =>  1,

    //Set Standard For Pagination on the Application
    'paginate'  => 10,


    'quotes' => [
        ["text" => "Today is the most productive day of the week!", "author" => "Anonymous"],
        ["text" => "Believe you can and you're halfway there.", "author" => "Theodore Roosevelt"],
        ["text" => "Start where you are. Use what you have. Do what you can.", "author" => "Arthur Ashe"],
        ["text" => "Success is not final, failure is not fatal: it is the courage to continue that counts.", "author" => "Winston Churchill"],
        ["text" => "The secret of getting ahead is getting started.", "author" => "Mark Twain"],
        ["text" => "Don’t watch the clock; do what it does. Keep going.", "author" => "Sam Levenson"],
        ["text" => "It always seems impossible until it’s done.", "author" => "Nelson Mandela"],
        ["text" => "Opportunities don't happen. You create them.", "author" => "Chris Grosser"],
        ["text" => "Your time is limited, so don’t waste it living someone else’s life.", "author" => "Steve Jobs"],
        ["text" => "Success usually comes to those who are too busy to be looking for it.", "author" => "Henry David Thoreau"],
        ["text" => "The way to get started is to quit talking and begin doing.", "author" => "Walt Disney"],
        ["text" => "Hard work beats talent when talent doesn’t work hard.", "author" => "Tim Notke"],
        ["text" => "I’m a greater believer in luck, and I find the harder I work the more I have of it.", "author" => "Thomas Jefferson"],
        ["text" => "If you really look closely, most overnight successes took a long time.", "author" => "Steve Jobs"],
        ["text" => "Do not wait to strike till the iron is hot; but make it hot by striking.", "author" => "William Butler Yeats"],
    ],


    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name'              =>  env('APP_NAME', 'SHIELDMASTER AFRICA'),
    'company_tagline'   =>  'Your Home of Security Services',
    'phone'             =>  "+254799147582",
    'email'             =>  "info@shieldmaster.africa",
    'pin'               =>  "p0xxxxxxx",
    'address'           =>  "Nairobi, Kenya.",
    'twitter'           =>  'https://twitter.com',
    'linked-in'         =>  'https://www.linkedin.com',
    'instagram'         =>  'https://www.instagram.com',
    'facebook'          =>  'https://www.facebook.com',
    'location_iq'       =>  env('LOCATION_IQ'),

    'version'           => env('APP_VERSION', '1.0.0'),

    'release_date' => env('APP_RELEASE_DATE', '5TH MAY 2023'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url'       => env('APP_URL', 'http://localhost'),
    'domain'    => env('APP_DOMAIN','vappsio.com'),

    'asset_url' => env('ASSET_URL', '/'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

   'timezone' => 'Africa/Nairobi',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Maatwebsite\Excel\ExcelServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
        'PDF' => Barryvdh\DomPDF\Facade::class,
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
    ])->toArray(),

];
