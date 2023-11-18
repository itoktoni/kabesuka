<?php

namespace Modules\Procurement\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Procurement\Dao\Enums\SupplierPph;
use Modules\Procurement\Dao\Enums\SupplierPpn;
use Modules\Procurement\Dao\Enums\SupplierType;
use Wildside\Userstamps\Userstamps;

class Partner extends Model
{
    protected $table = 'partner';
    protected $primaryKey = 'partner_id';

    protected $fillable = [
        'partner_id',
        'partner_name',
        'partner_description',
        'partner_address',
        'partner_phone',
        'partner_contact',
        'partner_email',
    ];

    protected $casts = [
        'partner_ppn' => 'integer',
        'partner_pph' => 'integer',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'partner_name' => 'required|min:3',
        // 'partner_phone' => 'required',
        // 'partner_ppn' => 'required',
        // 'partner_email' => 'required|email',
        // 'partner_contact' => 'required',
        // 'partner_address' => 'required',
        // 'partner_description' => 'required',
        // 'partner_pph' => 'required_if:partner_ppn,1',
        // 'partner_npwp' => 'integer|required_if:partner_ppn,1',
        // 'partner_pkp' => 'integer|required_if:partner_ppn,1',
    ];

    public $searching = 'partner_name';
    public $datatable = [
        'partner_id' => [false => 'Code', 'width' => 50],
        'partner_name' => [true => 'Nama Partner'],
        'partner_contact' => [true => 'PIC'],
        'partner_phone' => [true => 'Phone'],
        'partner_email' => [true => 'Email'],
    ];

    public function mask_name()
    {
        return 'partner_name';
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
        return 'partner_address';
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
        return 'partner_ppn';
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
        $value = intval($this->{$this->mask_ppn()});
        return strtoupper(SupplierPpn::getDescription($value)) ?? '';
    }

    public function mask_pph()
    {
        return 'partner_pph';
    }

    public function setMaskPphAttribute($value)
    {
        $this->attributes[$this->mask_pph()] = $value;
    }

    public function getMaskPphAttribute()
    {
        return $this->{$this->mask_pph()};
    }

    public function getMaskPphNameAttribute()
    {
        $value = intval($this->{$this->mask_pph()});
        return strtoupper(SupplierPph::getDescription($value)) ?? '';
    }

}
