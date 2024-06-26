<?php

use Kirschbaum\PowerJoins\PowerJoinsServiceProvider;
use Modules\Finance\Dao\Enums\PaymentMethod;
use Modules\Item\Dao\Enums\CategoryType;
use Modules\Marketing\Dao\Enums\PageType;
use Modules\Master\Dao\Enums\PaymentModel;
use Modules\Procurement\Dao\Enums\DeliveryStatus;
use Modules\Procurement\Dao\Enums\PurchasePayment;
use Modules\Procurement\Dao\Enums\PurchaseStatus;
use Modules\Procurement\Dao\Enums\RequestStatus;
use Modules\Procurement\Dao\Enums\SalesStatus;
use Modules\Reservation\Dao\Enums\BookingType;
use Modules\Reservation\Dao\Enums\PaymentType;
use Modules\Reservation\Dao\Enums\TypeBooking;
use Modules\System\Dao\Enums\ActionStatus;
use Modules\System\Dao\Enums\GroupUserType;
use Modules\System\Plugins\Adapter;
use Modules\System\Plugins\Views;
use Modules\System\Plugins\Notes;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Lang;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Query;
use Modules\System\Providers\CacheableAuthUserServiceProvider;
use Modules\Transaction\Dao\Enums\TransactionStatus;

$url_hostname = '';

if (isset($_SERVER['SERVER_NAME'])) {
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
        $protocol = 'http://';
    } else {
        $protocol = 'https://';
    }
    if (!in_array($_SERVER['SERVER_PORT'], [80, 443])) {
        $port = ":$_SERVER[SERVER_PORT]";
    } else {
        $port = '';
    }
    $server_name = $_SERVER['SERVER_NAME'];

    $url_hostname = $protocol . $server_name . $port . dirname($_SERVER['PHP_SELF']);
}

return [

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

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
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

    'debug' => env('APP_DEBUG', false),

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

    'url' => env('APP_URL', $url_hostname),
    'asset_url' => env('ASSET_URL', null),

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

    'timezone' => 'Asia/Jakarta',

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

    'locale' => env('APP_LOCAL', 'en'),
    'faker_locale' => 'id_ID',

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
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
     */

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

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
        App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\TelescopeServiceProvider::class,
        Thedevsaddam\LaravelSchema\LaravelSchemaServiceProvider::class,
        Jackiedo\DotenvEditor\DotenvEditorServiceProvider::class,
        CacheableAuthUserServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,
        Alkhachatryan\LaravelWebConsole\LaravelWebConsoleServiceProvider::class,
        Maatwebsite\Excel\ExcelServiceProvider::class,
        Laravolt\Avatar\ServiceProvider::class,
        Ixudra\Curl\CurlServiceProvider::class,
        GeoSot\EnvEditor\ServiceProvider::class,
        PowerJoinsServiceProvider::class,
        SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,
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

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Larapack\ConfigWriter\Facade::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Str' => Illuminate\Support\Str::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Datatables' => Yajra\Datatables\Facades\Datatables::class,
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        'Helper' => Helper::class,
        'Adapter' => Adapter::class,
        'Views' => Views::class,
        'Notes' => Notes::class,
        'Lang' => Lang::class,
        'Alert' => Alert::class,
        'Chrome' => Chrome::class,
        'ActionStatus' => ActionStatus::class,
        'TransactionStatus' => TransactionStatus::class,
        'PurchaseStatus' => PurchaseStatus::class,
        'SalesStatus' => SalesStatus::class,
        'DeliveryStatus' => DeliveryStatus::class,
        'CategoryType' => CategoryType::class,
        'PaymentModel' => PaymentModel::class,
        'GroupUserStatus' => GroupUserStatus::class,
        'PdfFacade' => Barryvdh\DomPDF\PdfFacade::class,
        'DotenvEditor' => Jackiedo\DotenvEditor\Facades\DotenvEditor::class,
        'Curl' => Ixudra\Curl\Facades\Curl::class,
        'Image' => Intervention\Image\Facades\Image::class,
        'Avatar' => Laravolt\Avatar\Facade::class,
        'Client' => Webklex\IMAP\Facades\Client::class,
        'PDF' => Barryvdh\DomPDF\Facade::class,
        'EnvEditor' => GeoSot\EnvEditor\Facades\EnvEditor::class,
        'Query' => Query::class,
        'GroupUserType' => GroupUserType::class,
        'PurchasePayment' => PurchasePayment::class,
        'PaymentMethod' => PaymentMethod::class,
        'PaymentType' => PaymentType::class,
        'BookingType' => BookingType::class,
        'SalesStatus' => SalesStatus::class,
        'TypeBooking' => TypeBooking::class,
        'PageType' => PageType::class,
        'RequestStatus' => RequestStatus::class,
        'BARCODE1D' => Milon\Barcode\Facades\DNS1DFacade::class,
        'BARCODE2D' => Milon\Barcode\Facades\DNS2DFacade::class,
        'QrCode' => SimpleSoftwareIO\QrCode\Facades\QrCode::class,
    ],

];
