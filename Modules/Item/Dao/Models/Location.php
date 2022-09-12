<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Enums\unitType;
use Wildside\Userstamps\Userstamps;

class Location extends Model
{
    protected $table = 'location';
    protected $primaryKey = 'location_id';

    protected $fillable = [
        'location_id',
        'location_name',
        'location_description',
        'location_warehouse_id',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'location_name' => 'required|min:3',
    ];

    public $searching = 'location_name';
    public $datatable = [
        'location_id' => [false => 'Code', 'width' => 50],
        'location_name' => [true => 'Name'],
    ];

    public function mask_name()
    {
        return 'location_name';
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
