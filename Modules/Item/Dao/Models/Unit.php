<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Enums\unitType;
use Wildside\Userstamps\Userstamps;

class Unit extends Model
{
    protected $table = 'unit';
    protected $primaryKey = 'unit_code';

    protected $fillable = [
        'unit_code',
        'unit_name',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'unit_name' => 'required|min:3',
    ];

    public $searching = 'unit_name';
    public $datatable = [
        'unit_code' => [false => 'Code', 'width' => 50],
        'unit_name' => [true => 'Name'],
    ];

    public function mask_name()
    {
        return 'unit_name';
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
