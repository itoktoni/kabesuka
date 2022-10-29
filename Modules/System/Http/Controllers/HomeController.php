<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Closure;
use Alkhachatryan\LaravelWebConsole\LaravelWebConsole;
use Illuminate\Support\Facades\Cache;
use Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Modules\Reservation\Dao\Enums\BookingType;
use Modules\Reservation\Dao\Models\Booking;
use Modules\System\Dao\Enums\GroupUserStatus;
use Modules\System\Dao\Enums\GroupUserType;
use Modules\System\Dao\Facades\GroupUserFacades;
use Modules\System\Http\Charts\HomeChart;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'access', 'verified']);
    }

    public function route()
    {
        $middlewareClosure = function ($middleware) {
            return $middleware instanceof Closure ? 'Closure' : $middleware;
        };

        $routes = collect(Route::getRoutes());

        foreach (config('pretty-routes.hide_matching') as $regex) {
            $routes = $routes->filter(function ($value, $key) use ($regex) {
                return !preg_match($regex, $value->uri());
            });
        }

        return view(Views::form('route', 'home'), [
            'routes' => $routes,
            'middlewareClosure' => $middlewareClosure,
        ]);
    }

    public function console()
    {
        return LaravelWebConsole::show();
    }

    public function session_group($code)
    {
        session()->put(Auth::User()->username . '_group_access', $code);
        return redirect()->to(route('home'));
    }

    public function dashboard()
    {
        if (env('ENABLE_FRONTEND', true) && auth()->user()->group_user == GroupUserType::Customer) {
            return redirect('/');
        }

        $username = auth()->user()->username;

        $chart = new HomeChart();
        $month = [];

        for ($m=1; $m<=12; $m++) {
            $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
            $booking = Booking::whereMonth('booking_date', $m)
            ->whereYear('booking_date', date('Y'))
            ->where('booking_status', '>=', BookingType::Table)->get();
            $qty[] = $booking->sum('booking_qty');
            $value[] = $booking->sum('booking_summary');
        }

        $chart->labels($month);
        $chart->dataset('Total Value Per Bulan', 'bar', $value)->backgroundColor('#0088cc')->fill(true);
        // $chart->dataset('Target', 'bar', [])->backgroundColor('#ddf1fa')->fill(true);
        // $chart->dataset('Value', 'bar', $value)->backgroundColor('#ddf1fa')->fill(true);
        $chart->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ]
        ]);

        if(auth()->user()->group_user == GroupUserType::Customer){
            return redirect()->to('/');
        }

        return view(Views::form('dashboard', 'home'), ['chart' => $chart]);
    }

    public function timers()
    {
        if(auth()->user()->group_user == GroupUserType::Customer){
            return redirect()->to('/');
        }

        return view(Views::form('timer', 'home'));
    }

    public function configuration()
    {
        return redirect('/setting');
    }

    public function language()
    {
        return redirect('/languages');
    }

}
