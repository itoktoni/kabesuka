<?php

namespace Modules\Procurement\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Item\Dao\Facades\MakananFacades;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Models\Makanan;
use Modules\Item\Dao\Models\Product;
use Modules\Procurement\Dao\Facades\PoFacades;

class SoDetail extends Model
{
    protected $table = 'so_detail';
    protected $primaryKey = 'so_detail_so_code';

    protected $fillable = [
        'so_detail_so_code',
        'so_detail_notes',
        'so_detail_product_id',
        'so_detail_product_price',
        'so_detail_qty',
        'so_detail_price',
        'so_detail_total',
        'so_detail_receive',
        'so_detail_remaining',
    ];

    // public $with = ['has_product'];

    public $timestamps = false;
    public $incrementing = false;

    public function mask_so_code()
    {
        return 'so_detail_so_code';
    }

    public function setMaskSoCodeAttribute($value)
    {
        $this->attributes[$this->mask_so_code()] = $value;
    }

    public function getMaskSoCodeAttribute()
    {
        return $this->{$this->mask_so_code()};
    }

    public function mask_product_id()
    {
        return 'so_detail_product_id';
    }

    public function setMaskProductIdAttribute($value)
    {
        $this->attributes[$this->mask_product_id()] = $value;
    }

    public function getMaskProductIdAttribute()
    {
        return $this->{$this->mask_product_id()};
    }

    public function getMaskProductNameAttribute()
    {
        return $this->has_product->product_name;
    }

    public function mask_product_price()
    {
        return 'so_detail_product_price';
    }

    public function setMaskProductPriceAttribute($value)
    {
        $this->attributes[$this->mask_product_price()] = $value;
    }

    public function getMaskProductPriceAttribute()
    {
        return $this->{$this->mask_product_price()};
    }

    public function mask_receive_price()
    {
        return 'so_detail_receive_price';
    }

    public function setMaskReceivePriceAttribute($value)
    {
        $this->attributes[$this->mask_receive_price()] = $value;
    }

    public function getMaskReceivePriceAttribute()
    {
        return $this->{$this->mask_receive_price()};
    }


    public function mask_qty()
    {
        return 'so_detail_qty';
    }

    public function setMaskQtyAttribute($value)
    {
        $this->attributes[$this->mask_qty()] = $value;
    }

    public function getMaskQtyAttribute()
    {
        return $this->{$this->mask_qty()};
    }

    public function mask_price()
    {
        return 'so_detail_price';
    }

    public function setMaskPriceAttribute($value)
    {
        $this->attributes[$this->mask_price()] = $value;
    }

    public function getMaskPriceAttribute()
    {
        return $this->{$this->mask_price()};
    }

    public function mask_sent()
    {
        return 'so_detail_sent';
    }

    public function setMaskSentAttribute($value)
    {
        $this->attributes[$this->mask_deliver()] = $value;
    }

    public function getMaskSentAttribute()
    {
        return $this->{$this->mask_sent()};
    }

    public function mask_receive()
    {
        return 'so_detail_receive';
    }

    public function setMaskReceiveAttribute($value)
    {
        $this->attributes[$this->mask_receive()] = $value;
    }

    public function getMaskReceiveAttribute()
    {
        return $this->{$this->mask_receive()};
    }

    public function mask_notes()
    {
        return 'so_detail_notes';
    }

    public function setMaskNotesAttribute($value)
    {
        $this->attributes[$this->mask_notes()] = $value;
    }

    public function getMaskNotesAttribute()
    {
        return $this->{$this->mask_notes()};
    }

    public function mask_total()
    {
        return 'so_detail_total';
    }

    public function setMaskTotalAttribute($value)
    {
        $this->attributes[$this->mask_total()] = $value;
    }

    public function getMaskTotalAttribute()
    {
        return $this->{$this->mask_total()};
    }

    public function has_product()
    {
        return $this->hasOne(Makanan::class, MakananFacades::getKeyName(), $this->mask_product_id());
    }

    public function has_master()
    {
        return $this->hasOne(Po::class, PoFacades::getKeyName(), $this->mask_so_code());
    }
}
