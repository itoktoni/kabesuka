<?php

namespace Modules\Reservation\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Modules\Reservation\Dao\Enums\BookingType;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class Booking extends Model
{
    use Userstamps, PowerJoins,  FilterQueryString;

    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'booking_id',
        'booking_date',
        'booking_sort',
        'booking_meja_code',
        'booking_email',
        'booking_phone',
        'booking_name',
        'booking_start_date',
        'booking_end_date',
        'booking_code',
        'booking_status',
        'booking_paid',
        'booking_member_id',
        'booking_qty',
        'booking_lansia_qty',
        'booking_lansia_price',
        'booking_dewasa_qty',
        'booking_dewasa_price',
        'booking_anak_qty',
        'booking_anak_price',
        'booking_price',
        'booking_value',
        'booking_ppn_value',
        'booking_ppn_percent',
        'booking_total',
        'booking_discount_description',
        'booking_discount_value',
        'booking_discount_code',
        'booking_sisa',
        'booking_dp',
        'booking_bayar',
        'booking_kembali',
        'booking_metode',
        'booking_summary',
        'booking_reference',
        'booking_start_time',
        'booking_end_time',
        'booking_qris_content',
        'booking_qris_request_date',
        'booking_qris_invoiceid',
        'booking_qris_nmid',
        'booking_qris_date',
        'booking_qris_status',
        'booking_qris_payment_customername',
        'booking_qris_payment_methodby',
        'booking_created_at',
        'booking_updated_at',
        'booking_deleted_at',
        'booking_created_by',
        'booking_updated_by',
        'booking_deleted_by',
        'booking_type',
    ];

    protected $filters = [
        'booking_member_id',
        'booking_metode',
        'booking_status',
    ];

    const CREATED_AT = 'booking_created_at';
    const UPDATED_AT = 'booking_updated_at';
    const DELETED_AT = 'booking_deleted_at';
    const CREATED_BY = 'booking_created_by';
    const UPDATED_BY = 'booking_updated_by';
    const DELETED_BY = 'booking_deleted_by';

    protected $casts = [
        'booking_qty' => 'integer',
        'booking_status' => 'integer',
        'booking_start_time' => 'datetime',
        'booking_end_time' => 'datetime',
        'booking_created_at' => 'datetime',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = true;
    public $rules = [
        'booking_qty' => 'required',
    ];

    public $searching = 'booking_code';
    public $datatable = [
        'booking_id' => [false => 'Code', 'width' => 50],
        'booking_code' => [true => 'Code'],
        'booking_date' => [true => 'Tanggal', 'width' => 60],
        'booking_name' => [true => 'Name'],
        'booking_email' => [false => 'Email'],
        'booking_phone' => [false => 'Phone'],
        'booking_dewasa_qty' => [false => 'Dewasa'],
        'booking_anak_qty' => [false => 'Anak'],
        'booking_lansia_qty' => [false => 'Lansia'],
        'booking_value' => [true => 'Value', 'width' => 50],
        'booking_metode' => [true => 'Metode'],
        'booking_type' => [true => 'Type'],
        'booking_discount_value' => [true => 'Discount', 'width' => 60],
        'booking_dp' => [true => 'Payment', 'width' => 60],
        'booking_qty' => [true => 'Qty', 'width' => '25'],
        'booking_summary' => [true => 'Summary', 'width' => 60],
        'booking_status' => [true => 'Status', 'width' => '50'],
    ];

    public function mask_name()
    {
        return 'booking_code';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function has_member()
    {
        return $this->hasone(User::class, TeamFacades::getKeyName(), 'booking_member_id');
    }

    public static function boot()
    {
        parent::saving(function ($model) {

            if ($model->booking_status == BookingType::Finish) {
                $user = User::find(request()->get('booking_member_id'));
                if ($user) {
                    $user->point = $user->point + 1;
                    $user->save();
                }
            }

        });

        parent::boot();
    }

}
