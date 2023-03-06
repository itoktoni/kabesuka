<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Modules\System\Dao\Facades\ActionFacades;
use Modules\System\Http\Controllers\HomeController;
use Modules\System\Http\Controllers\TeamController;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Views;
use Illuminate\Support\Str;

/*
routing for admin
 */

Route::group(
    [
        'middleware' =>
        [
            'auth',
            'access',
            'verified',
        ],
    ],
    function () {
        try {
            Route::group(['prefix' => 'dashboard'], function () {
                if (Cache::has('routing')) {
                    $cache_query = Cache::get('routing');
                    $method = ['create', 'save', 'delete', 'data', 'index'];
                    foreach ($cache_query as $route) {
                        $link = $route->system_action_link . '/{code}';

                        if (in_array($route->system_action_function, $method) || strpos($route->system_action_code, 'report') !== false  || strpos($route->system_action_code, 'post') !== false || strpos($route->system_action_code, 'list') !== false || strpos($route->system_action_code, 'index') !== false || strpos($route->system_action_code, 'data') !== false) {

                            $link = $route->system_action_link;
                        }

                        $path = $route->system_action_path . '@' . Str::camel($route->system_action_function);
                        Route::match($route->system_action_method, $link, $path)->name($route->system_action_code);
                    }
                } else {
                    $cache_query = Cache::rememberForever('routing', function () {
                        $get_query = DB::table(ActionFacades::getTable())
                        ->where('system_action_enable', 1)
                        ->orderByDesc('system_action_sort')
                        ->orderBy('system_action_path')
                        ->orderBy('system_action_function')
                        ->get();
                        return $get_query;
                    });
                }
            });
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }
);

/*
developer
 */

Route::get('timers', [HomeController::class, 'timers'])->name('timers');
Route::get('dashboard', [HomeController::class, 'dashboard'])->name('home');
Route::get('route', [HomeController::class, 'route'])->name('route');
Route::get('console', [HomeController::class, 'console'])->name('console');
Route::get('language', [HomeController::class, 'language'])->name('language');
Route::get('home', [HomeController::class, 'dashboard']);
Route::match(['get', 'post'], 'configuration', [HomeController::class, 'configuration'])->name('configuration');
route::post('upload', function () {
    // $data = request()->file('upload');
    // $name = Helper::uploadImage($data, 'files/page');

    // $response = [
    //     'success' => true,
    //     'url' => Helper::files('page/' . $name),
    // ];

    $file = request()->file('upload');
    $name = Helper::uploadImage($file, 'page');

    $response = [
        'uploaded' => true,
        'url' => Helper::files('page/'.$name),
    ];


    return response()->json($response);
})->name('upload');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('groups/{code}', [HomeController::class, 'session_group'])->name('access_group');
        Route::get('user/reset', [TeamController::class, 'reset_password'])->name('reset_password');
        Route::post('user/change_password', [TeamController::class, 'change_password'])->name('lock');
        Route::match(
            [
                'get',
                'post',
            ],
            'user/profile',
            [TeamController::class, 'show_profile']
        )->name('user_profile');
    });
});

/*
auth mechanizme
 */
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('register', 'PublicController@register')->name('register');
Route::get('reset', [TeamController::class, 'reset_redis'])->name('reset');
Route::get('reboot', [TeamController::class, 'reset_routing'])->name('reboot');

Route::get('/', '\App\Http\Controllers\PublicController@index')->name('beranda');
Route::get('/about', '\App\Http\Controllers\PublicController@index')->name('about');
Route::get('/contact', '\App\Http\Controllers\PublicController@index')->name('contact');
Route::post('/booking', '\App\Http\Controllers\PublicController@booking')->name('booking');
Route::get('/payment/{code}', '\App\Http\Controllers\PublicController@payment')->name('payment');
Route::get('/page/{slug}', '\App\Http\Controllers\PublicController@page')->name('page');
Route::match(['POST', 'GET'],'/account', '\App\Http\Controllers\PublicController@account')->name('account');