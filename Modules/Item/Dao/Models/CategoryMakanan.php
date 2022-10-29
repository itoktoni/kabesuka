<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Modules\Item\Dao\Enums\CategoryType;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;

class CategoryMakanan extends Model
{
    protected $table = 'category_makanan';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_id',
        'category_name',
        'category_frontend',
        'category_image',
        'category_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'category_name' => 'required|min:3',
    ];

    public $searching = 'category_name';
    public $datatable = [
        'category_id' => [false => 'Code', 'width' => 50],
        'category_name' => [true => 'Name'],
        'category_image' => [false => 'Type'],
        'category_description' => [true => 'Description'],
    ];

    public function mask_name()
    {
        return 'category_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public static function boot()
    {
        parent::boot();
        parent::saving(function ($model) {

            $file = 'file';
            if (request()->has($file)) {
                $image = $model->category_image;
                if ($image) {
                    Helper::removeImage($image, Helper::getTemplate(__CLASS__));
                }

                $file = request()->file($file);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->category_image = $name;
            }
        });

        parent::deleting(function ($model) {
            if (request()->has('id')) {
                $data = $model->getDataIn(request()->get('id'));
                if ($data) {
                    foreach ($data as $value) {
                        Helper::removeImage($value->category_image, Helper::getTemplate(__CLASS__));
                    }
                }
            }
        });
    }
}
