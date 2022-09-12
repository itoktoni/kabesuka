<?php

namespace Modules\Reservation\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Reservation\Dao\Enums\CustomerType;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;

class Promo extends Model
{
    protected $table = 'promo';
    protected $primaryKey = 'promo_code';

    protected $fillable = [
        'promo_code',
        'promo_name',
        'promo_description',
        'promo_status',
        'promo_matrix',
    ];

    protected $casts = [
        'promo_status' => 'integer',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'promo_name' => 'required',
        'promo_matrix' => 'required',
        'promo_status' => 'required',
    ];

    public $searching = 'promo_name';
    public $datatable = [
        'promo_code' => [true => 'Code'],
        'promo_name' => [true => 'Name'],
        'promo_matrix' => [true => 'Matrix'],
    ];

    public static function boot()
    {
        parent::saving(function ($model) {
            $model->promo_code = Str::snake($model->promo_name);
        });

        parent::boot();
    }
}
