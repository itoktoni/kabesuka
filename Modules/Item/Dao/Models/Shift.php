<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Enums\shiftType;
use Wildside\Userstamps\Userstamps;

class Shift extends Model
{
    protected $table = 'shift';
    protected $primaryKey = 'shift_id';

    protected $fillable = [
        'shift_id',
        'shift_name',
        'shift_start',
        'shift_end',
        'shift_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'shift_name' => 'required|min:3',
    ];

    public $searching = 'shift_name';
    public $datatable = [
        'shift_id' => [false => 'Code', 'width' => 50],
        'shift_name' => [true => 'Name'],
        'shift_start' => [true => 'Start Date'],
        'shift_end' => [true => 'End Date'],
        'shift_description' => [true => 'Description'],
    ];

    protected $casts = [
        'shift_start' => 'date:Y-m-d',
        'shift_end' => 'date:Y-m-d',
    ];

    public function mask_name()
    {
        return 'shift_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function has_jadwal()
    {
        return $this->hasMany(Jadwal::class, 'jadwal_shift_id', $this->getKeyName());
    }

    public static function boot()
    {
        parent::boot();
        parent::saved(function ($model) {
            if(request()->has('user')){
                $users = request()->get('user');
                Jadwal::where('jadwal_shift_id', $model->shift_id)->delete();
                $total = $model->shift_start->diffInDays($model->shift_end);
                $adjust = $model->shift_start;
                for($i=0;$i < $total;$i++){
                    $adjust->addDay(1)->format('Y-m-d');
                    foreach($users as $user){
                        Jadwal::create([
                            'jadwal_shift_id' => $model->shift_id,
                            'jadwal_name' => $model->shift_name,
                            'jadwal_date' => $adjust,
                            'jadwal_user_id' => $user,
                        ]);
                    }
                }
            }
        });

        parent::deleting(function ($model) {
            Jadwal::where('jadwal_shift_id', $model->shift_id)->delete();
        });
    }
}
