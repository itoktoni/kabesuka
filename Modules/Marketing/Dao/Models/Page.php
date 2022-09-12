<?php

namespace Modules\Marketing\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $table = 'marketing_page';
    protected $primaryKey = 'marketing_page_id';

    protected $fillable = [
        'marketing_page_id',
        'marketing_page_name',
        'marketing_page_slug',
        'marketing_page_description',
        'marketing_page_status',
        'marketing_page_created_at',
        'marketing_page_updated_at',
        'marketing_page_created_by',
    ];

    protected $casts = [
        'marketing_page_name' => 'string',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'marketing_page_name' => 'required|min:3',
    ];

    public $searching = 'marketing_page_name';
    public $datatable = [
        'marketing_page_id' => [false => 'Code', 'width' => 50],
        'marketing_page_name' => [true => 'Name'],
        'marketing_page_slug' => [true => 'Name'],
        'marketing_page_description' => [false => 'Name'],
        'marketing_page_status' => [true => 'Name'],
    ];

    public function mask_name()
    {
        return 'marketing_page_name';
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

            $file = 'marketing_page_file';
            if (request()->has($file)) {
                $image = $model->marketing_page_image;
                if ($image) {
                    Helper::removeImage($image, Helper::getTemplate(__CLASS__));
                }

                $file = request()->file($file);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->marketing_page_image = $name;
            }

            if ($model->marketing_page_name && empty($model->marketing_page_slug)) {
                $model->marketing_page_slug = Str::slug($model->marketing_page_name);
            }

            if (Cache::has('marketing_page_api')) {
                Cache::forget('marketing_page_api');
            }
        });

        parent::deleting(function ($model) {
            if (request()->has('id')) {
                $data = $model->getDataIn(request()->get('id'));
                if ($data) {
                    foreach ($data as $value) {
                        Helper::removeImage($value->marketing_page_image, Helper::getTemplate(__CLASS__));
                    }
                }
            }
        });
    }
}
