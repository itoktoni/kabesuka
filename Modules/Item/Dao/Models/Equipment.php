<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Enums\unitType;
use Modules\Item\Dao\Facades\LocationFacades;
use Wildside\Userstamps\Userstamps;

class Equipment extends Model
{
    protected $table = 'equipment';
    protected $primaryKey = 'equipment_id';

    protected $fillable = [
        'equipment_id',
        'equipment_name',
        'equipment_description',
        'equipment_stock',
        'equipment_status',
        'equipment_location_id',
        'equipment_created_at',
        'equipment_updated_at',
        'equipment_deleted_at',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'equipment_name' => 'required|min:3',
        'equipment_stock' => 'required',
        'equipment_location_id' => 'required',
    ];

    public $searching = 'equipment_name';
    public $datatable = [
        'equipment_id' => [false => 'Code', 'width' => 50],
        'location_name' => [true => 'Location'],
        'equipment_name' => [true => 'Name'],
        'equipment_stock' => [true => 'Stock'],
        'equipment_status' => [true => 'Status'],
    ];

    public function mask_name()
    {
        return 'equipment_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function mask_location_id()
    {
        return 'equipment_location_id';
    }

    public function setMaskLocationAttribute($value)
    {
        $this->attributes[$this->mask_location_id()] = $value;
    }

    public function getMaskLocationAttribute()
    {
        return $this->{$this->mask_location_id()};
    }

    public function has_location()
    {
        return $this->hasone(Location::class, LocationFacades::getKeyName(), $this->mask_location_id());
    }
}
