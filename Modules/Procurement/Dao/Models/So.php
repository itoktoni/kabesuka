<?php

namespace Modules\Procurement\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Kirschbaum\SowerJoins\SowerJoins;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Modules\Finance\Dao\Facades\PaymentFacades;
use Modules\Finance\Dao\Models\Payment;
use Modules\Procurement\Dao\Enums\PurchasePayment;
use Modules\Procurement\Dao\Facades\SoDetailFacades;
use Modules\Procurement\Dao\Facades\SoFacades;
use Modules\Procurement\Dao\Facades\SupplierFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;

class So extends Model
{
    use SoftDeletes, Userstamps, PowerJoins, FilterQueryString;

    protected $table = 'so';
    protected $primaryKey = 'so_code';
    protected $primaryType = 'string';

    protected $fillable = [
        'so_code',
        'so_date_order',
        'so_created_at',
        'so_updated_at',
        'so_processed_at',
        'so_delivered_at',
        'so_deleted_at',
        'so_created_by',
        'so_updated_by',
        'so_deleted_by',
        'so_customer_name',
        'so_customer_id',
        'so_code_delivery',
        'so_code_invoice',
        'so_status',
        'so_notes_internal',
        'so_notes_external',
        'so_discount_name',
        'so_discount_value',
        'so_sum_value',
        'so_sum_discount',
        'so_sum_total',
        'so_company_id',
        'so_company_name',
        'so_company_address',
        'so_job_code',
    ];

    // public $with = ['has_detail'];

    protected $filters = [
        'so_customer_id'
    ];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'so_code' => 'required|min:3',
    ];

    const CREATED_AT = 'so_created_at';
    const UPDATED_AT = 'so_updated_at';
    const DELETED_AT = 'so_deleted_at';

    const CREATED_BY = 'so_created_by';
    const UPDATED_BY = 'so_updated_by';
    const DELETED_BY = 'so_deleted_by';

    public $searching = 'so_code';
    public $datatable = [
        'so_code' => [true => 'Sales Code', 'width' => 100],
        'so_date_order' => [true => 'Date', 'width' => 60],
        'so_updated_at' => [false => 'Last At', 'width' => 50],
        'so_customer_name' => [true => 'Nama Customer', 'width' => 150],
        'so_notes_internal' => [true => 'Catatan'],
        'so_sum_value' => [false => 'Value', 'width' => 80],
        'so_sum_total' => [true => 'Total', 'width' => 70],
        'so_status' => [true => 'Status', 'width' => 70, 'class' => 'text-center', 'status' => 'status'],
    ];

    protected $casts = [
        'so_created_at' => 'datetime:Y-m-d H:i:s',
        'so_updated_at' => 'datetime:Y-m-d H:i:s',
        'so_status' => 'integer',
    ];

    public function mask_status()
    {
        return 'so_status';
    }

    public function setMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_status()] = $value;
    }

    public function getMaskStatusAttribute()
    {
        return $this->{$this->mask_status()};
    }

    public function mask_last_status()
    {
        return 'so_last_status';
    }

    public function setLastMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_last_status()] = $value;
    }

    public function getLastMaskStatusAttribute()
    {
        return $this->{$this->mask_last_status()};
    }

    public function mask_supplier_id()
    {
        return 'so_supplier_id';
    }

    public function setMaskSupplierIdAttribute($value)
    {
        $this->attributes[$this->mask_supplier_id()] = $value;
    }

    public function getMaskSupplierIdAttribute()
    {
        return $this->{$this->mask_supplier_id()};
    }

    public function getMaskSupplierNameAttribute()
    {
        return $this->has_supplier->supplier_name ?? '';
    }

    public function mask_total()
    {
        return 'so_sum_total';
    }

    public function setMaskTotalAttribute($value)
    {
        $this->attributes[$this->mask_total()] = $value;
    }

    public function getMaskTotalAttribute()
    {
        return $this->{$this->mask_total()};
    }

    public function getMaskTotalRupiahAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_total()});
    }

    public function mask_notes()
    {
        return 'so_notes';
    }

    public function setMaskNotesAttribute($value)
    {
        $this->attributes[$this->mask_notes()] = $value;
    }

    public function getMaskNotesAttribute()
    {
        return $this->{$this->mask_notes()};
    }

    public function getMaskTotalFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_total()});
    }

    public function mask_value()
    {
        return 'so_sum_value';
    }

    public function setMaskValueAttribute($value)
    {
        $this->attributes[$this->mask_value()] = $value;
    }

    public function getMaskValueAttribute()
    {
        return $this->{$this->mask_value()};
    }

    public function getMaskValueFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_value()});
    }

    public function mask_discount()
    {
        return 'so_sum_discount';
    }

    public function mask_discount_value()
    {
        return 'so_discount_value';
    }

    public function setMaskDiscountAttribute($value)
    {
        $this->attributes[$this->mask_discount()] = $value;
    }

    public function getMaskDiscountAttribute()
    {
        return $this->{$this->mask_discount()};
    }

    public function getMaskDiscountFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_discount()});
    }

    public function mask_tax()
    {
        return 'so_sum_tax';
    }

    public function setMaskTaxAttribute($value)
    {
        $this->attributes[$this->mask_tax()] = $value;
    }

    public function getMaskTaxAttribute()
    {
        return $this->{$this->mask_tax()};
    }

    public function getMaskTaxFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_tax()});
    }

    public function mask_location_id()
    {
        return 'so_location_id';
    }

    public function setMaskLocationIdAttribute($value)
    {
        $this->attributes[$this->mask_location_id()] = $value;
    }

    public function getMaskLocationIdAttribute()
    {
        return $this->{$this->mask_location_id()};
    }

    public function mask_dpp()
    {
        return 'so_sum_dpp';
    }

    public function setMaskDppAttribute($value)
    {
        $this->attributes[$this->mask_dpp()] = $value;
    }

    public function getMaskDppAttribute()
    {
        return $this->{$this->mask_dpp()};
    }

    public function getMaskDppFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_dpp()});
    }

    public function mask_ppn()
    {
        return 'so_sum_ppn';
    }

    public function setMaskPpnAttribute($value)
    {
        $this->attributes[$this->mask_ppn()] = $value;
    }

    public function getMaskPpnAttribute()
    {
        return $this->{$this->mask_ppn()};
    }

    public function getMaskPpnFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_ppn()});
    }

    public function mask_pph()
    {
        return 'so_sum_pph';
    }

    public function setMaskPphAttribute($value)
    {
        $this->attributes[$this->mask_pph()] = $value;
    }

    public function getMaskPphAttribute()
    {
        return $this->{$this->mask_pph()};
    }

    public function getMaskPphFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_pph()});
    }

    public function mask_created_at()
    {
        return self::CREATED_AT;
    }

    public function setMaskCreatedAtAttribute($value)
    {
        $this->attributes[$this->mask_created_at()] = $value;
    }

    public function getMaskCreatedAtAttribute()
    {
        return $this->{$this->mask_created_at()};
    }

    public function mask_created_by()
    {
        return self::CREATED_BY;
    }

    public function setMaskCreatedByAttribute($value)
    {
        $this->attributes[$this->mask_created_by()] = $value;
    }

    public function getMaskCreatedByAttribute()
    {
        return $this->{$this->mask_created_by()};
    }

    public function has_detail()
    {
        return $this->hasMany(SoDetail::class, SoDetailFacades::mask_so_code(), SoFacades::getKeyName());
    }

    public function has_user()
    {
        return $this->hasone(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }

    public function has_supplier()
    {
        return $this->hasone(Supplier::class, SupplierFacades::getKeyName(), $this->mask_supplier_id());
    }

    public function has_payment()
    {
        return $this->hasMany(Payment::class, PaymentFacades::mask_reference(), $this->getKeyName());
    }

    public static function boot()
    {
        parent::updated(function($model){
            // $model-> = $model->mask_status;
        });

        parent::boot();
    }


}
