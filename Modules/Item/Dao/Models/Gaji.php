<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Enums\gajiType;
use Wildside\Userstamps\Userstamps;

class Gaji extends Model
{
    protected $table = 'gaji';
    protected $primaryKey = 'gaji_id';

    protected $fillable = [
        'gaji_id',
        'gaji_name',
        'gaji_date',
        'gaji_start',
        'gaji_end',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'gaji_name' => 'required|min:3',
    ];

    public $searching = 'gaji_name';
    public $datatable = [
        'gaji_id' => [false => 'Code', 'width' => 50],
        'gaji_name' => [true => 'Nama Gajian'],
        'gaji_date' => [true => 'Date'],
        'gaji_start' => [true => 'Jadwal Start'],
        'gaji_end' => [true => 'Jadwal End'],
    ];

    protected $casts = [
        'gaji_date' => 'date:Y-m-d',
    ];

    public function mask_name()
    {
        return 'gaji_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function has_detail()
    {
        return $this->hasMany(GajiDetail::class, 'gaji_detail_gaji_id', $this->getKeyName());
    }

    public static function boot()
    {
        parent::boot();

        parent::deleting(function ($model) {
            GajiDetail::where('gaji_detail_gaji_id', $model->gaji_id)->delete();
        });
    }

}
