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

    //Verbose Invoice setting showing more information
    'customer-prefix'               =>  'GNCU-',
    'invoice-code'                  =>  true,
    'invoice-prefix'                =>  'GNCU-',
    'invoice-verbose'               =>  false,
    'invoice-fix-date'              =>  true,
    'invoice-date'                  =>  15,
    'invoice-show-address'          =>  false,
    'invoice-contact-person'        =>  true,
    'show_invoice_balance'          =>  true,
    'show-invoice-recepient'        =>  true,
    'show-customer-code'            =>  false,
    'sequential-invoice-numbering'  =>  true,
    'invoice-sequence-initial'      =>  1400,
    'invoice-item-description'      =>  true,
    'statement_reverse'             =>  true,
    'generate_zone_invoices'        =>  false,

    //Invoice Template setting Options : simple, main, straight
    'invoice_template'  => 'main',

    //Serial Number Prefix
    'serial_number_prefix' => '',

    //Approval & Disapproval Limits
    'approval_requirement'  =>  2,
    'disapproval_requirement'  =>  1,

    //Allow Salary Payable Deployements
    'salary_payable_deployements'   =>  true,

    //Day of the month to run the payroll
    'payroll_date'  =>  1,

    //Payslip Type Print
    'payslip-minimal'   => true,

    //Payslip Template setting Options : main, simple, minimal
    'payslip_template'  => 'main',

    //Pay for ended deployments
    'pay_past_deployments'  => false,

    //Payroll Settings
    'comprehensive-report'  => true,

    //Show column totals at bottom of payroll reports
    'show-payroll-totals'   =>  true,

    //Deduct only one installment per month or multiple
    'deduct_multiple_gear'  =>  false,

    //Set a priority type of gear deduction
    'priority_gear_deductable'  =>  'boots',

    //threshold limit for deductions. The system will not deduct if the employee earned below this amount
    'deductions_threshold' => 1,

    //Ideal single gear deduction amount. Note that this will deduct only one item if matched to the assigned items. eg. Boots at 1500 will only deduct boots for that month.
    'max_deduction_amount'  => 1600,

    //Setting for tiered or non-tiered/fixed rate statutory deductions
    'tiered_statutory_deduction'    => false,

    //Affordable Housing Rates
    'AHLF_percentage'   => 1.5,
    'AHLF_fixed_rate'   => 90,

    //NHIF Settings Lower and Upper limits.
    'nhif_employer_code'    => '123123',
    'NHIF_LEL'              => 24000,
    'NHIF_fixed_rate'       => 300,
    'NHIF_upper_deduction'  => 500,
    'NHIF_lower_deduction'  => 300,

    //NSSF Settings Lower and Upper Earning Limit i.e., LEL & UEL resp.
    'NSSF_fixed_rate'  =>   610,
    'NSSF_percentage'  =>   6,
    'LEL'              =>   7000,
    'UEL'              =>   36000,

    //Paye Personal Relief
    'activate_personal_relief' => true,

    //PR amount
    'personal_relief'=>  2400,

    //Set Standard For Pagination on the Application
    'paginate'  => 10,

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the applica
    tion's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name'              =>  env('APP_NAME', 'VAPPS IO'),
    'company_tagline'   =>  'Security that makes business sense.',
    'postal_address'    =>  '944',
    'postal_code'       =>  '00100, GPO',
    'address'           =>  'NAIROBI, KENYA',
    'phone'             =>  "0799147582",
    'email'             =>  "alamin.mashar@gmail.com",
    'pin'               =>  "P05160L",
    'main_email'        =>  'info@shieldmaster.africa',
    'twitter'           =>  'https://twitter.com',
    'linked-in'         =>  'https://www.linkedin.com',
    'instagram'         =>  'https://www.instagram.com',
    'facebook'          =>  'https://www.facebook.com',

    'version' => env('APP_VERSION', '1.2.1'),

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
    'env' => env('APP_URL', 'production'),

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

    'asset_url' => env('ASSET_URL'),

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

    'timezone' => 'UTC',

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
        Maatwebsite\Excel\ExcelServiceProvider::class,
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
