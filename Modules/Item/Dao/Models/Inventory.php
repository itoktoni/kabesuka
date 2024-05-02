<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Modules\Item\Dao\Enums\inventoryType;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;
use Kirschbaum\PowerJoins\PowerJoins;

class Inventory extends Model
{
    use PowerJoins;

    protected $table = 'inventory';
    protected $primaryKey = 'inventory_code';

    protected $fillable = [
        'inventory_code',
        'inventory_type',
        'inventory_product_id',
        'inventory_date',
        'awal_pagi',
        'masuk_pagi',
        'akhir_pagi',
        'keluar_pagi',
        'awal_malam',
        'masuk_malam',
        'akhir_malam',
        'keluar_malam',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = true;
    public $rules = [
    ];

    public $searching = 'inventory_code';
    public $datatable = [
        'inventory_code' => [true => 'Code'],
        'product_name' => [true => 'Product', 'width' => 150],
        'inventory_date' => [true => 'Tanggal'],
        'awal_pagi' => [true => 'P awal'],
        'masuk_pagi' => [true => 'P masuk'],
        'akhir_pagi' => [true => 'P akhir'],
        'keluar_pagi' => [true => 'P keluar'],
        'awal_malam' => [true => 'M awal'],
        'masuk_malam' => [true => 'M masuk'],
        'akhir_malam' => [true => 'M akhir'],
        'keluar_malam' => [true => 'M keluar'],
    ];

    public function mask_name()
    {
        return 'inventory_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function has_product()
    {
        return $this->hasOne(Product::class, 'product_id', 'inventory_product_id');
    }

    public static function boot()
    {
        parent::boot();
        parent::saving(function ($model) {

            $file = 'file';
            if (request()->has($file)) {
                $image = $model->inventory_image;
                if ($image) {
                    Helper::removeImage($image, Helper::getTemplate(__CLASS__));
                }

                $file = request()->file($file);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->inventory_image = $name;
            }
        });

        parent::deleting(function ($model) {
            if (request()->has('id')) {
                $data = $model->getDataIn(request()->get('id'));
                if ($data) {
                    foreach ($data as $value) {
                        Helper::removeImage($value->inventory_image, Helper::getTemplate(__CLASS__));
                    }
                }
            }
        });
    }
}
