<?php

namespace Modules\Item\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Enums\jadwalType;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'jadwal_id';

    protected $fillable = [
        'jadwal_id',
        'jadwal_name',
        'jadwal_date',
        'jadwal_shift_id',
        'jadwal_description',
        'jadwal_user_id',
        'jadwal_created_at',
        'jadwal_updated_at',
        'jadwal_created_by',
        'jadwal_updated_by',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'jadwal_name' => 'required|min:3',
    ];

    public $searching = 'jadwal_name';
    public $datatable = [
        'jadwal_id' => [false => 'Code', 'width' => 50],
        'jadwal_name' => [true => 'Name'],
        'name' => [true => 'Name Karyawan'],
        'jadwal_date' => [true => 'Tanggal'],
    ];

    const CREATED_AT = 'jadwal_created_at';
    const UPDATED_AT = 'jadwal_updated_at';

    const CREATED_BY = 'jadwal_created_by';
    const UPDATED_BY = 'jadwal_updated_by';

    public function mask_name()
    {
        return 'jadwal_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function has_shift()
    {
        return $this->hasOne(Shift::class, (new Shift())->getKeyName(), 'jadwal_shift_id');
    }

    public function has_user()
    {
        return $this->hasOne(User::class, TeamFacades::getKeyName(), 'jadwal_user_id');
    }
}
