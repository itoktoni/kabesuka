<?php

namespace Modules\Reservation\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Reservation\Dao\Enums\CustomerType;
use Wildside\Userstamps\Userstamps;

class Customer extends User
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_description',
        'customer_address',
        'customer_phone',
        'customer_email',
        'customer_rt',
        'customer_rw',
        'customer_province',
        'customer_city',
        'customer_area',
        'customer_ppn',
        'customer_npwp',
        'customer_pkp',
        'customer_contact',
        'customer_owner',
    ];

    protected $casts = [
        'customer_ppn' => 'integer',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'customer_name' => 'required|min:3',
        'customer_phone' => 'required',
        'customer_email' => 'required|email',
        'customer_address' => 'required|min:10',
    ];

    public $searching = 'customer_name';
    public $datatable = [
        'customer_id' => [false => 'Code', 'width' => 50],
        'customer_name' => [true => 'Name'],
        'customer_phone' => [true => 'Phone'],
        'customer_email' => [true => 'Email'],
        'customer_ppn' => [true => 'PKP/Non PKP'],
    ];

    public function mask_name()
    {
        return 'customer_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function mask_address()
    {
        return 'customer_address';
    }

    public function setMaskAddressAttribute($value)
    {
        $this->attributes[$this->mask_address()] = $value;
    }

    public function getMaskAddressAttribute()
    {
        return $this->{$this->mask_address()};
    }

    public function mask_ppn()
    {
        return 'customer_ppn';
    }

    public function setMaskPpnAttribute($value)
    {
        $this->attributes[$this->mask_ppn()] = $value;
    }

    public function getMaskPpnAttribute()
    {
        return $this->{$this->mask_ppn()};
    }

    public function getMaskPpnNameAttribute()
    {
        return CustomerType::getDescription($this->{$this->mask_ppn()}) ?? '';
    }

}
