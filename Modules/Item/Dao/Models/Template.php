<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Modules\Item\Dao\Enums\templateType;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;

class Template extends Model
{
    protected $table = 'template';
    protected $primaryKey = 'template_id';

    protected $fillable = [
        'template_id',
        'template_name',
        'template_image',
        'template_url',
        'template_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'template_name' => 'required|min:3',
    ];

    public $searching = 'template_name';
    public $datatable = [
        'template_id' => [false => 'Code', 'width' => 50],
        'template_name' => [true => 'Name'],
        'template_description' => [true => 'Description'],
    ];

    public function mask_name()
    {
        return 'template_name';
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
                $file = request()->file($file);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->template_image = $name;
            }
        });

        parent::deleting(function ($model) {
            if (request()->has('id')) {
                $data = $model->getDataIn(request()->get('id'));
                if ($data) {
                    foreach ($data as $value) {
                        Helper::removeImage($value->template_image, Helper::getTemplate(__CLASS__));
                    }
                }
            }
        });
    }
}
