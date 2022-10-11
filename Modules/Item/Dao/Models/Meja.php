<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Enums\mejaType;
use Wildside\Userstamps\Userstamps;

class Meja extends Model
{
    protected $table = 'meja';
    protected $primaryKey = 'meja_code';

    protected $fillable = [
        'meja_code',
        'meja_name',
        'meja_capacity_start',
        'meja_capacity_end',
        'meja_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'meja_name' => 'required|min:3',
    ];

    public $searching = 'meja_name';
    public $datatable = [
        'meja_code' => [false => 'Code', 'width' => 50],
        'meja_name' => [true => 'Name'],
    ];

    public function mask_name()
    {
        return 'meja_name';
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
