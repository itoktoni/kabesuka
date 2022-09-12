<?php

use App\Http\Controllers\APIController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Modules\Reservation\Dao\Enums\BookingType;
use Modules\Reservation\Dao\Models\Booking;
use Modules\System\Http\Controllers\ActionController;
use Modules\System\Plugins\Helper;

// use Helper;
// use Curl;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
//

// Route::post('register_api', 'APIController@register');
// Route::post('login_api', [APIController::class, 'login']);
// Route::post('air_login', 'APIController@airLogin');

// Route::post('token', [ActionController::class, 'data'])->middleware('auth:sanctum');

Route::post(
    'waiting_list',
    function () {
        $detail = Booking::whereIn('booking_status', [BookingType::Booked, BookingType::Process])
        ->where('booking_date', date('Y-m-d'))
        ->whereNull('booking_end_time')
        ->where('booking_meja_code', request()->get('id'))
        ->orWhereIn('booking_status', [BookingType::Booked, BookingType::Process])
        ->where('booking_end_time', '>=', date('Y-m-d H:i:s'))
        ->where('booking_date', date('Y-m-d'))
        ->where('booking_meja_code', request()->get('id'))
        ->orderBy('booking_code')
        ->get();
        return view(Helper::setViewDashboard('waitlist'))->with(['detail' => $detail]);
    }
)->name('waiting_list');