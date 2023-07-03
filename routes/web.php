<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Reservation\Dao\Enums\BookingType;
use Modules\Reservation\Dao\Models\Booking;
use Modules\Reservation\Dao\Models\Promo;
use Modules\System\Plugins\Helper;
use PHPUnit\TextUI\Help;

Auth::routes(['verify' => true]);

Route::match(
    [
        'GET',
        'POST',
    ],
    'user',
    function () {
        $input = request()->get('id');
        $query = User::where('id', $input);
        $data = $query->first();
        $data['qty'] = Helper::point($data->email);
        return $data;
    }
)->name('user');

Route::get(
    'timer',
    function () {
        $detail = Booking::where('booking_status', BookingType::Table)
        ->where('booking_date', date('Y-m-d'))
        ->get();
        return view(Helper::setViewDashboard('table'))->with(['detail' => $detail]);
    }
)->name('timer');



Route::match(
    [
        'GET',
        'POST',
    ],
    'promo',
    function () {
        $promo = 0;
        $input = request()->get('id');
        $value = Helper::filterInput(request()->get('value'));
        $dp = empty(request()->get('dp')) ? 0 : request()->get('dp');
        $query = Promo::where('promo_code', $input)->first();

        $total = $value + Helper::filterInput($dp);
        $name = '';

        if ($query) {
            $matrix = $query->promo_matrix;
            $name = $query->promo_name;
            $string = str_replace('@value', $total, $matrix);
            try {
                $promo = Helper::calculate($string);
                $total = ($total - $promo);

            } catch (\Throwable $th) {
            }
        }

        $total = $total + ($total * (env('PPN') / 100));

        return [
            'total' => $total,
            'discount' => $promo,
            'name' => $name,
        ];
    }
)->name('promo');
