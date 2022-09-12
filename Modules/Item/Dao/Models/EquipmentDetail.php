<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Enums\unitType;
use Modules\Item\Dao\Facades\LocationFacades;
use Wildside\Userstamps\Userstamps;

class EquipmentDetail extends Model
{
    protected $table = 'equipment_detail';
    protected $primaryKey = 'equipment_detail_id';

    protected $fillable = [
        'equipment_detail_id',
        'equipment_detail_type',
        'equipment_detail_description',
        'equipment_detail_stock_old',
        'equipment_detail_stock_new',
        'equipment_detail_refer_id',
        'equipment_detail_created_at',
        'equipment_detail_updated_at',
        'equipment_detail_created_by',
        'equipment_detail_updated_by',
    ];

    const CREATED_AT = 'equipment_detail_created_at';
    const UPDATED_AT = 'equipment_detail_updated_at';

    const CREATED_BY = 'equipment_detail_created_by';
    const UPDATED_BY = 'equipment_detail_updated_by';

    public $timestamps = true;
    public $incrementing = true;
    public $rules = [
        'equipment_detail_type' => 'required|min:3',
        'equipment_detail_description' => 'required',
    ];

    public $searching = 'equipment_detail_description';
    public $datatable = [
        'equipment_detail_type' => [false => 'Code', 'width' => 50],
        'equipment_detail_description' => [true => 'Location'],
    ];
}
