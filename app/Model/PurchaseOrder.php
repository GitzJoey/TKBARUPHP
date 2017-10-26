<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:50 PM
 */

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\PurchaseOrder
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $supplier_id
 * @property integer $warehouse_id
 * @property integer $vendor_trucking_id
 * @property string $code
 * @property \Carbon\Carbon $po_created
 * @property string $po_type
 * @property \Carbon\Carbon $shipping_date
 * @property string $supplier_type
 * @property string $walk_in_supplier
 * @property string $walk_in_supplier_detail
 * @property string $article_code
 * @property string $remarks
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Item[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Receipt[] $receipts
 * @property-read \App\Model\Supplier $supplier
 * @property-read \App\Model\VendorTrucking $vendorTrucking
 * @property-read \App\Model\Store $store
 * @property-read \App\Model\Warehouse $warehouse
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Payment[] $payments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Expense[] $expenses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrderCopy[] $copies
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereSupplierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereVendorTruckingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder wherePoCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder wherePoType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereShippingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereSupplierType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereWalkInSupplier($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereWalkInSupplierDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereArticleCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereDeletedAt($value)
 * @mixin \Eloquent
 * @property float $disc_percent
 * @property float $disc_value
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereDiscPercent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereDiscValue($value)
 * @property string $internal_remarks
 * @property string $private_remarks
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereInternalRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder wherePrivateRemarks($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder withoutTrashed()
 * @property-read mixed $h_id
 */
class PurchaseOrder extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $table = 'purchase_orders';

    protected $dates = ['deleted_at', 'po_created', 'shipping_date'];

    protected $fillable = [
        'code',
        'po_type',
        'po_created',
        'shipping_date',
        'supplier_type',
        'walk_in_supplier',
        'walk_in_supplier_detail',
        'remarks',
        'internal_remarks',
        'private_remarks',
        'status',
        'supplier_id',
        'vendor_trucking_id',
        'warehouse_id',
        'store_id',
        'disc_percent',
        'disc_value',
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $appends = [
        'hId'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function getHIdAttribute()
    {
        return $this->hId();
    }

    public function items()
    {
        return $this->morphMany('App\Model\Item', 'itemable');
    }

    public function receipts()
    {
        return $this->hasManyThrough('App\Model\Receipt', 'App\Model\Item', 'itemable_id', 'item_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Model\Supplier', 'supplier_id');
    }

    public function vendorTrucking()
    {
        return $this->belongsTo('App\Model\VendorTrucking', 'vendor_trucking_id');
    }

    public function store()
    {
        return $this->belongsTo('App\Model\Store', 'store_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse', 'warehouse_id');
    }

    public function payments()
    {
        return $this->morphMany('App\Model\Payment', 'payable');
    }

    public function cashPayments()
    {
        return $this->payments->filter(function ($payment){
            return $payment->type === 'PAYMENTTYPE.C';
        });
    }

    public function transferPayments()
    {
        return $this->payments->filter(function ($payment){
            return $payment->type === 'PAYMENTTYPE.T';
        });
    }

    public function giroPayments()
    {
        return $this->payments->filter(function ($payment){
            return $payment->type === 'PAYMENTTYPE.G';
        });
    }

    public function totalAmount()
    {
        $itemAmounts = $this->items->map(function($item){
            return $item->price * $item->to_base_quantity;
        });

        $itemTotalAmount = count($itemAmounts) > 0 ? $itemAmounts->sum() : 0;

        $itemDiscounts = $this->items->map(function ($item) {
            return $item->discounts->map(function ($discount) {
                return $discount->item_disc_value;
            })->all();
        })->flatten();

        $itemDiscountAmount = count($itemDiscounts) > 0 ? $itemDiscounts->sum() : 0;

        $expenseAmounts = $this->expenses->map(function ($expense){
            return $expense->type === 'EXPENSETYPE.ADD' ? $expense->amount : ($expense->amount * -1);
        });

        $expenseTotalAmount = count($expenseAmounts) > 0 ? $expenseAmounts->sum() : 0;

        return $itemTotalAmount + $expenseTotalAmount - $itemDiscountAmount - $this->disc_value;
    }

    public function totalAmountPaid()
    {
        return $this->payments->filter(function ($payment, $key){
            return $payment->status !== 'TRFPAYMENTSTATUS.UNCONFIRMED'
            && $payment->status !== 'GIROPAYMENTSTATUS.WE'
            && $payment->status !== 'PAYMENTTYPE.FR';
        })->sum('total_amount');
    }

    public function expenses()
    {
        return $this->morphMany('App\Model\Expense', 'expensable');
    }

    public function copies()
    {
        return $this->hasMany('App\Model\PurchaseOrderCopy', 'main_po_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            if ($user) {
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
            }
        });

        static::updating(function ($model) {
            $user = Auth::user();
            if ($user) {
                $model->updated_by = $user->id;
            }
        });

        static::deleting(function ($model) {
            $user = Auth::user();
            if ($user) {
                $model->deleted_by = $user->id;
                $model->save();
            }
        });
    }
}