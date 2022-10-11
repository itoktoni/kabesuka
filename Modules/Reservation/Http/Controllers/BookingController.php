<?php

namespace Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Models\Meja;
use Modules\Item\Dao\Repositories\MejaRepository;
use Modules\Reservation\Dao\Enums\BookingType;
use Modules\Reservation\Dao\Models\Booking;
use Modules\Reservation\Dao\Repositories\BookingRepository;
use Modules\Reservation\Dao\Repositories\PromoRepository;
use Modules\Reservation\Http\Requests\BookingRequest;
use Modules\Reservation\Http\Services\BookingCreateService;
use Modules\Reservation\Http\Services\BookingUpdateService;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;
use Ixudra\Curl\Facades\Curl;

class BookingController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(BookingRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $jam = [
            null => '- Pilih Jam -',
            '11:00' => '11:00',
            '11:30' => '11:30',
            '12:00' => '12:00',
            '12:30' => '12:30',
            '13:00' => '13:00',
            '13:30' => '13:30',
            '14:00' => '14:00',
            '14:30' => '14:30',
            '15:00' => '15:00',
            '15:30' => '15:30',
            '16:00' => '16:00',
            '16:30' => '16:30',
            '17:00' => '17:00',
            '17:30' => '17:30',
            '18:00' => '18:00',
            '18:30' => '18:30',
            '19:00' => '19:00',
            '19:30' => '19:30',
            '20:00' => '20:00',
            '20:30' => '20:30',
        ];
        $user = Views::option(new TeamRepository(), false, true)
            ->where(TeamFacades::mask_group_user(),'customer')
            ->pluck('name', 'id')
            ->prepend('- Select Customer -', '');

        $meja = Views::option(new MejaRepository());
        $promo = Views::option(new PromoRepository());

        $view = [
            'status' => BookingType::getOptions(),
            'user' => $user,
            'promo' => $promo,
            'jam' => $jam,
            'meja' => $meja,
        ];

        return array_merge($view, $data);
    }

    public function index()
    {
        return view(Views::index())->with([
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    public function create()
    {
        return view(Views::create())->with($this->share(
            [
                'status' => BookingType::getOptions([
                    BookingType::Create,
                    BookingType::Process
                ])
            ]
        ));
    }

    public function save(BookingRequest $request, BookingCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        if(isset($data['status']) && $data['data']){
            return redirect()->route('reservation_booking_edit', ['code' => $data['data']->booking_id]);
        }
        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->EditStatus([
                'booking_status' => BookingType::class,
            ])
            ->make();
    }

    public function edit($code)
    {
        $model = $this->get($code);

        $area = $city = [];

        $province_data = request()->get('customer_province') ?? $model->customer_province ?? null;
        if($province_data){

            $city = DB::table('rajaongkir_cities')
            ->where('rajaongkir_city_province_id', $province_data)
            ->get()->pluck('rajaongkir_city_name', 'rajaongkir_city_id');
        }

        $city_data = request()->get('customer_city') ?? $model->customer_city ?? null;
        if($city_data){

            $area = DB::table('rajaongkir_areas')->where('rajaongkir_area_city_id', $city_data)
            ->pluck('rajaongkir_area_name','rajaongkir_area_id')->prepend('- Select Area -');
        }

        return view(Views::update(config('page'), config('folder')))->with($this->share([
            'model' => $model,
            'city' => $city,
            'area' => $area,
        ]));
    }

    public function update($code, BookingRequest $request, BookingUpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        if(isset($data['status']) && $data['data']){
            return redirect()->route('reservation_booking_edit', ['code' => $data['data']['booking_id']]);
        }
    }

    public function show($code)
    {
        return view(Views::show())->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $this->get($code),
        ]));
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$model, $code, $relation);
        }
        return self::$service->get(self::$model, $code);
    }

    public function delete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }

    public function printQris($code){
        $model = $this->get($code);

        $dewasa = $model->booking_dewasa_qty > 0 ? 1 : 0;
        $lansia = $model->booking_lansia_qty > 0 ? 1 : 0;
        $anak = $model->booking_anak_qty > 0 ? 1 : 0;

        $total = $dewasa + $lansia + $anak;

        $data = [
            'master' => $model,
            'total' => $total,
        ];

        if($model->booking_qris_status != 'paid'){

            $get_qris = Curl::to(env('QRIS_CHECK'))->withData([
                'do' => 'Check',
                'apikey' => env('QRIS_KEY'),
                'mID' => env('QRIS_MID'),
                'invid' => $model->booking_qris_invoiceid,
                'trxvalue' => 1,
                'trxdate' => $model->booking_qris_date,
            ])->get();

            $check_qris = json_decode($get_qris);

            $qris_check = $check_qris->data;
            if($check_qris->status == 'success'){
                $model->update([
                    'booking_qris_status' => $qris_check->qris_status,
                    'booking_qris_payment_customername' => $qris_check->qris_payment_customername,
                    'booking_qris_payment_methodby' => $qris_check->qris_payment_methodby,
                ]);
            }
            else{
                $model->update([
                    'booking_qris_status' => $qris_check->qris_status,
                ]);

                $payload = [
                    'qris_status' => $qris_check->qris_status,
                    'qris_customer' => '',
                    'qris_method' => '',
                ];
            }
        }

        // $pdf = PDF::loadView(Helper::setViewPrint('qris', config('folder')), $data);
        $pdf = PDF::loadView(Helper::setViewPrint('qris', config('folder')), $data)->setPaper(array( 0 , 0 , 226 , 380 + ($total * 20) ));
        return $pdf->stream();
    }

    public function printInvoice($code){
        $model = $this->get($code);

        $end = Carbon::parse(date('Y-m-d H:i:s'))
        ->addMinutes(env('WAKTU_MAKAN', 90))
        ->format('Y-m-d H:i:s');
        $model->booking_start_time = date('Y-m-d H:i:s');
        $model->booking_end_time = $end;
        $model->save();

        $dewasa = $model->booking_dewasa_qty > 0 ? 1 : 0;
        $lansia = $model->booking_lansia_qty > 0 ? 1 : 0;
        $anak = $model->booking_anak_qty > 0 ? 1 : 0;

        $total = $dewasa + $lansia + $anak;
        $data = [
            'master' => $model,
            'total' => $total,
        ];

        $pdf = PDF::loadView(Helper::setViewPrint('invoice', config('folder')), $data)->setPaper(array( 0 , 0 , 226 , 370 + ($total * 20) ));
        return $pdf->stream();
    }

    public function printStart($code){
        $model = $this->get($code);
        $dewasa = $model->booking_dewasa_qty > 0 ? 1 : 0;
        $lansia = $model->booking_lansia_qty > 0 ? 1 : 0;
        $anak = $model->booking_anak_qty > 0 ? 1 : 0;

        $total = $dewasa + $lansia + $anak;
        $data = [
            'master' => $model,
            'total' => $total,
        ];

        $pdf = PDF::loadView(Helper::setViewPrint('invoice', config('folder')), $data)->setPaper(array( 0 , 0 , 226 , 350 + ($total * 20) ));
        return $pdf->stream();
    }

    public function printAntrian($code){
        $model = $this->get($code);
        $dewasa = $model->booking_dewasa_qty > 0 ? 1 : 0;
        $lansia = $model->booking_lansia_qty > 0 ? 1 : 0;
        $anak = $model->booking_anak_qty > 0 ? 1 : 0;

        $total = $dewasa + $lansia + $anak;
        $data = [
            'master' => $model,
            'total' => $total,
        ];

        $pdf = PDF::loadView(Helper::setViewPrint('antrian', config('folder')), $data)->setPaper(array( 0 , 0 , 226 , 180 ));
        return $pdf->stream();
    }
}
