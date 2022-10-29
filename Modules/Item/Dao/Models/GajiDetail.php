<?php

namespace Modules\Item\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Enums\gajiType;
use Wildside\Userstamps\Userstamps;

class GajiDetail extends Model
{
    protected $table = 'gaji_detail';
    protected $primaryKey = 'gaji_detail_id';

    protected $fillable = [
        'gaji_detail_id',
        'gaji_detail_gaji_id',
        'gaji_detail_date',
        'gaji_detail_user_id',
        'gaji_detail_default',
        'gaji_detail_lembur',
        'gaji_detail_bonus',
        'gaji_detail_potongan',
        'gaji_detail_qty',
        'gaji_detail_harian',
        'gaji_detail_total_harian',
        'gaji_detail_total_lembur',
        'gaji_detail_total',
        'gaji_detail_group_user',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'gaji_detail_name' => 'required|min:3',
    ];

    public $searching = 'gaji_detail_name';
    public $datatable = [
        'gaji_detail_id' => [false => 'Code', 'width' => 50],
        'gaji_detail_name' => [true => 'Name'],
    ];

    protected $casts = [
        'gaji_detail_date' => 'date:Y-m-d',
    ];

    public function mask_name()
    {
        return 'gaji_detail_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function has_user()
    {
        return $this->hasOne(User::class, 'id', 'gaji_detail_user_id');
    }

}
