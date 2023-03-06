<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\System\Plugins\Helper;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'notifikasi_id';

    protected $fillable = [
        'notifikasi_id',
        'notifikasi_name',
        'notifikasi_content',
        'notifikasi_image',
        'notifikasi_phone',
        'notifikasi_start',
        'notifikasi_end',
        'notifikasi_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'notifikasi_name' => 'required',
    ];

    public $searching = 'notifikasi_name';
    public $datatable = [
        'notifikasi_id' => [false => 'Code', 'width' => 50],
        'notifikasi_name' => [true => 'Name'],
        'notifikasi_description' => [true => 'Description'],
    ];

    public function mask_name()
    {
        return 'notifikasi_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }
}
