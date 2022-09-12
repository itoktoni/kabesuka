<?php

namespace Modules\Marketing\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;

class Promo extends Model
{
    protected $table = 'marketing_slider';
    protected $primaryKey = 'marketing_slider_id';

    protected $fillable = [
        'marketing_slider_id',
        'marketing_slider_name',
        'marketing_slider_slug',
        'marketing_slider_description',
        'marketing_slider_page',
        'marketing_slider_link',
        'marketing_slider_image',
        'marketing_slider_created_at',
        'marketing_slider_created_by',
        'marketing_slider_button',
    ];

    protected $casts = [
        'marketing_slider_name' => 'string',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'marketing_slider_name' => 'required|min:3',
    ];

    public $searching = 'marketing_slider_name';
    public $datatable = [
        'marketing_slider_id' => [false => 'Code', 'width' => 50],
        'marketing_slider_name' => [true => 'Name'],
        'marketing_slider_image' => [true => 'Image'],
    ];

    public function mask_name()
    {
        return 'marketing_slider_name';
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

            $file = 'marketing_slider_file';
            if (request()->has($file)) {
                $image = $model->marketing_slider_image;
                if ($image) {
                    Helper::removeImage($image, Helper::getTemplate(__CLASS__));
                }

                $file = request()->file($file);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->marketing_slider_image = $name;
            }

            if ($model->marketing_slider_name && empty($model->marketing_slider_slug)) {
                $model->marketing_slider_slug = Str::slug($model->marketing_slider_name);
            }

            if (Cache::has('marketing_slider_api')) {
                Cache::forget('marketing_slider_api');
            }
        });

        parent::deleting(function ($model) {
            if (request()->has('id')) {
                $data = $model->getDataIn(request()->get('id'));
                if ($data) {
                    foreach ($data as $value) {
                        Helper::removeImage($value->marketing_slider_image, Helper::getTemplate(__CLASS__));
                    }
                }
            }
        });
    }
}
