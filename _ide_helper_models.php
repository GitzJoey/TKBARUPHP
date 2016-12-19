<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Model{
/**
 * App\Bank
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $branch
 * @property string $branch_code
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereShortName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereBranch($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereBranchCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereUpdatedAt($value)
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bank whereDeletedAt($value)
 * @property-read mixed $bank_full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Giro[] $Giros
 */
	class Bank extends \Eloquent {}
}

namespace App\Model{
/**
 * App\BankAccount
 *
 * @property integer $id
 * @property integer $bank_id
 * @property string $account_number
 * @property string $remarks
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Supplier[] $supplier
 * @property-read \App\Bank $bank
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereBankId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Supplier[] $suppliers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Customer[] $customers
 * @property integer $owner_id
 * @property string $owner_type
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $owner
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereOwnerType($value)
 */
	class BankAccount extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\CashPayment
 *
 * @property integer $id
 * @property-read \App\Model\Payment $payment
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payment_detail
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CashPayment whereId($value)
 * @mixin \Eloquent
 */
	class CashPayment extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Customer
 *
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Profile[] $profile
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $phone_number
 * @property string $fax_num
 * @property string $tax_id
 * @property integer $payment_due_day
 * @property string $remarks
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereFaxNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePaymentDueDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Profile[] $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property integer $store_id
 * @property integer $price_level_id
 * @property-read \App\Model\PriceLevel $priceLevel
 * @property-read \App\Model\Store $store
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer wherePriceLevelId($value)
 * @property string $sign_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ExpenseTemplate[] $expenseTemplates
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereSignCode($value)
 */
	class Customer extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Deliver
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $item_id
 * @property integer $selected_unit_id
 * @property integer $base_unit_id
 * @property float $conversion_value
 * @property \Carbon\Carbon $deliver_date
 * @property float $brutto
 * @property float $base_brutto
 * @property float $netto
 * @property float $base_netto
 * @property float $tare
 * @property float $base_tare
 * @property string $licence_plate
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Item $item
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereSelectedUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBaseUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereConversionValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereDeliverDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBrutto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBaseBrutto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereNetto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBaseNetto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereTare($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBaseTare($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereLicencePlate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereDeletedAt($value)
 * @mixin \Eloquent
 * @property \Carbon\Carbon $confirm_receive_date
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereConfirmReceiveDate($value)
 * @property string $license_plate
 * @property string $remarks
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereLicensePlate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereRemarks($value)
 * @property string $article_code
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereArticleCode($value)
 */
	class Deliver extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Expense
 *
 * @property integer $id
 * @property integer $expensable_id
 * @property string $name
 * @property string $type
 * @property float $amount
 * @property string $remarks
 * @property string $expensable_type
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $expensable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereExpensableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereExpensableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereDeletedAt($value)
 * @mixin \Eloquent
 * @property boolean $is_internal_expense
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereIsInternalExpense($value)
 */
	class Expense extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ExpenseTemplate
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property float $amount
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereDeletedAt($value)
 * @mixin \Eloquent
 * @property boolean $is_internal_expense
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereIsInternalExpense($value)
 */
	class ExpenseTemplate extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Giro
 *
 * @property integer $id
 * @property integer $bank_id
 * @property string $serial_number
 * @property string $effective_date
 * @property float $amount
 * @property string $printed_name
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereBankId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereSerialNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereEffectiveDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro wherePrintedName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereDeletedAt($value)
 * @mixin \Eloquent
 * @property integer $store_id
 * @property string $status
 * @property-read \App\Model\Store $store
 * @property-read \App\Model\Bank $bank
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereStatus($value)
 * @property-read \App\Model\GiroPayment $giroPayment
 */
	class Giro extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\GiroPayment
 *
 * @property integer $id
 * @property integer $giro_id
 * @property-read \App\Model\Payment $payment
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payment_detail
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\GiroPayment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\GiroPayment whereGiroId($value)
 * @mixin \Eloquent
 * @property-read \App\Model\Giro $giro
 */
	class GiroPayment extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Item
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $store_id
 * @property integer $product_id
 * @property integer $stocks_id
 * @property integer $selected_unit_id
 * @property integer $base_unit_id
 * @property float $conversion_value
 * @property float $quantity
 * @property float $price
 * @property float $to_base_quantity
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereStocksId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereSelectedUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereBaseUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereConversionValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereToBaseQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereDeletedAt($value)
 * @property integer $stock_id
 * @property string $itemable_id
 * @property string $itemable_type
 * @property-read \App\Model\Product $product
 * @property-read \App\Model\ProductUnit $selectedUnit
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Receipt[] $receipts
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $itemable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereItemableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereItemableType($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Deliver[] $delivers
 */
	class Item extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Lookup
 *
 * @property string $code
 * @property string $description
 * @property string $category
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Lookup extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Payment
 *
 * @property integer $id
 * @property integer $store_id
 * @property \Carbon\Carbon $payment_date
 * @property float $total_amount
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $payment_detail_id
 * @property string $payment_detail_type
 * @property integer $payable_id
 * @property string $payable_type
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payment_detail
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePaymentDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereTotalAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePaymentDetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePaymentDetailType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePayableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePayableType($value)
 * @mixin \Eloquent
 * @property string $type
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereType($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Role $role
 */
	class Permission extends \Eloquent {}
}

namespace App\Model{
/**
 * App\PhoneNumber
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $phone_provider_id
 * @property string $number
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \App\PhoneProvider $provider
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber wherePhoneProviderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereDeletedAt($value)
 * @property integer $profile_id
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneNumber whereProfileId($value)
 */
	class PhoneNumber extends \Eloquent {}
}

namespace App\Model{
/**
 * App\PhoneProvider
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereShortName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $prefix
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider wherePrefix($value)
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereDeletedAt($value)
 */
	class PhoneProvider extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Price
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $stock_id
 * @property integer $price_level_id
 * @property \Carbon\Carbon $input_date
 * @property float $market_price
 * @property float $price
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price wherePriceLevelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereInputDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereMarketPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class Price extends \Eloquent {}
}

namespace App\Model{
/**
 * App\PriceLevel
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $store_id
 * @property string $type
 * @property integer $weight
 * @property string $name
 * @property string $description
 * @property integer $increment_value
 * @property integer $percentage_value
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereIncrementValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel wherePercentageValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereDeletedAt($value)
 */
	class PriceLevel extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Product
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $short_code
 * @property string $description
 * @property string $image_path
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereShortCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereImagePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $store_id
 * @property integer $product_type_id
 * @property-read \App\Store $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductUnit[] $productUnitList
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereProductTypeId($value)
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductUnit[] $productUnits
 */
	class Product extends \Eloquent {}
}

namespace App\Model{
/**
 * App\ProductType
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $store_id
 * @property string $name
 * @property string $short_code
 * @property string $description
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereShortCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Stock[] $stocks
 * @property-read \App\Model\Store $store
 */
	class ProductType extends \Eloquent {}
}

namespace App\Model{
/**
 * App\ProductUnit
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $store_id
 * @property integer $unit_id
 * @property boolean $is_base
 * @property float $conversion_value
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereIsBase($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereConversionValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereDeletedAt($value)
 * @property-read \App\Model\Product $product
 * @property-read \App\Model\Unit $unit
 */
	class ProductUnit extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Profile
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $user_id
 * @property string $ic_num
 * @property string $image_filename
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereIcNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereImageFilename($value)
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PhoneNumber[] $phone
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Supplier[] $supplier
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PhoneNumber[] $phoneNumbers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Supplier[] $suppliers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Customer[] $customers
 * @property integer $owner_id
 * @property string $owner_type
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $owner
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereOwnerType($value)
 */
	class Profile extends \Eloquent {}
}

namespace App\Model{
/**
 * App\PurchaseOrder
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $code
 * @property string $po_type
 * @property \Carbon\Carbon $po_created
 * @property \Carbon\Carbon $shipping_date
 * @property string $supplier_type
 * @property string $walk_in_supplier
 * @property string $walk_in_supplier_detail
 * @property string $remarks
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $supplier_id
 * @property integer $vendor_trucking_id
 * @property integer $store_id
 * @property integer $warehouse_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Items[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Payments[] $payments
 * @property-read \App\Model\Supplier $supplier
 * @property-read \App\Model\VendorTrucking $vendorTrucking
 * @property-read \App\Model\Store $store
 * @property-read \App\Model\Warehouse $warehouse
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder wherePoType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder wherePoCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereShippingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereSupplierType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereWalkInSupplier($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereWalkInSupplierDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereSupplierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereVendorTruckingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereWarehouseId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Receipt[] $receipts
 * @property string $article_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Expense[] $expenses
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereArticleCode($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrderCopy[] $copies
 */
	class PurchaseOrder extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\PurchaseOrderCopy
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $supplier_id
 * @property integer $warehouse_id
 * @property integer $vendor_trucking_id
 * @property integer $main_po_id
 * @property string $main_po_code
 * @property string $code
 * @property \Carbon\Carbon $po_created
 * @property string $po_type
 * @property \Carbon\Carbon $shipping_date
 * @property string $supplier_type
 * @property string $walk_in_supplier
 * @property string $walk_in_supplier_detail
 * @property string $article_code
 * @property string $main_po_remarks
 * @property string $remarks
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\PurchaseOrder $purchaseOrder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Item[] $items
 * @property-read \App\Model\Supplier $supplier
 * @property-read \App\Model\Warehouse $warehouse
 * @property-read \App\Model\VendorTrucking $vendorTrucking
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereSupplierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereVendorTruckingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereMainPoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereMainPoCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy wherePoCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy wherePoType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereShippingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereSupplierType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereWalkInSupplier($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereWalkInSupplierDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereArticleCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereMainPoRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class PurchaseOrderCopy extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Receipt
 *
 * @property integer $id
 * @property \Carbon\Carbon $receipt_date
 * @property float $brutto
 * @property float $netto
 * @property float $tare
 * @property string $licence_plate
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $item_id
 * @property integer $store_id
 * @property integer $selected_unit_id
 * @property-read \App\Model\Item $item
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereReceiptDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBrutto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereNetto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereTare($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereLicencePlate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereSelectedUnitId($value)
 * @mixin \Eloquent
 * @property integer $base_unit_id
 * @property float $base_brutto
 * @property float $base_netto
 * @property float $base_tare
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBaseUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBaseBrutto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBaseNetto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBaseTare($value)
 * @property float $conversion_value
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereConversionValue($value)
 * @property string $license_plate
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereLicensePlate($value)
 * @property string $article_code
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereArticleCode($value)
 */
	class Receipt extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $perms
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $permissionList
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Permission[] $permissions
 */
	class Role extends \Eloquent {}
}

namespace App\Model{
/**
 * App\SalesOrder
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $store_id
 * @property integer $customer_id
 * @property integer $vendor_truck_id
 * @property string $code
 * @property string $so_created
 * @property string $shipping_date
 * @property string $customer_type
 * @property string $walk_in_cust_detail
 * @property string $so_type
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereVendorTruckId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereSoCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereShippingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCustomerType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereWalkInCustDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereSoType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereDeletedAt($value)
 * @property string $walk_in_cust
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrder whereWalkInCust($value)
 * @property integer $warehouse_id
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrder whereWarehouseId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Item[] $items
 * @property integer $vendor_trucking_id
 * @property-read \App\Model\Customer $customer
 * @property-read \App\Model\Warehouse $warehouse
 * @property-read \App\Model\VendorTrucking $vendorTrucking
 * @property-read \App\Model\Store $store
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrder whereVendorTruckingId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Deliver[] $delivers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Payment[] $payments
 * @property string $article_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Expense[] $expenses
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrder whereArticleCode($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\SalesOrderCopy[] $copies
 */
	class SalesOrder extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\SalesOrderCopy
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $customer_id
 * @property integer $warehouse_id
 * @property integer $vendor_trucking_id
 * @property integer $main_so_id
 * @property string $main_so_code
 * @property string $code
 * @property \Carbon\Carbon $so_created
 * @property string $so_type
 * @property \Carbon\Carbon $shipping_date
 * @property string $customer_type
 * @property string $walk_in_cust
 * @property string $walk_in_cust_detail
 * @property string $article_code
 * @property string $status
 * @property string $main_so_remarks
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Item[] $items
 * @property-read \App\Model\Customer $customer
 * @property-read \App\Model\Warehouse $warehouse
 * @property-read \App\Model\VendorTrucking $vendorTrucking
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereVendorTruckingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereMainSoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereMainSoCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereSoCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereSoType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereShippingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCustomerType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereWalkInCust($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereWalkInCustDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereArticleCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereMainSoRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class SalesOrderCopy extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Settings
 *
 * @property string $skey
 * @property string $category
 * @property string $value
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereSkey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereUserId($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Stocks
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $store_id
 * @property integer $po_id
 * @property integer $product_id
 * @property integer $warehouse_id
 * @property float $quantity
 * @property float $current_quantity
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Product $product
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock wherePoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereCurrentQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Price[] $prices
 */
	class Stock extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\StockIn
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $po_id
 * @property integer $product_id
 * @property integer $stock_id
 * @property integer $warehouse_id
 * @property float $quantity
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn wherePoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class StockIn extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\StockOut
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $so_id
 * @property integer $product_id
 * @property integer $stock_id
 * @property integer $warehouse_id
 * @property float $quantity
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereSoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class StockOut extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Store
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone_num
 * @property string $fax_num
 * @property string $tax_id
 * @property string $status
 * @property string $is_default
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereFaxNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereIsDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $image_filename
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereImageFilename($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Giro[] $giros
 * @property string $frontweb
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereFrontweb($value)
 */
	class Store extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Supplier
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $phone_number
 * @property string $fax_num
 * @property string $tax_id
 * @property string $remarks
 * @property string $status
 * @property integer $payment_due_day
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Profile[] $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BankAccount[] $bank
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereFaxNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier wherePaymentDueDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Profile[] $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property integer $store_id
 * @property-read \App\Model\Store $store
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Supplier whereStoreId($value)
 * @property string $sign_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ExpenseTemplate[] $expenseTemplates
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Supplier whereSignCode($value)
 */
	class Supplier extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\TransferPayment
 *
 * @property integer $id
 * @property string $effective_date
 * @property integer $bank_from_id
 * @property integer $bank_to_id
 * @property-read \App\Model\Payment $payment
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TransferPayment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TransferPayment whereEffectiveDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TransferPayment whereBankFromId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TransferPayment whereBankToId($value)
 * @mixin \Eloquent
 * @property integer $bank_account_from_id
 * @property integer $bank_account_to_id
 * @property-read \App\Model\BankAccount $bankAccountFrom
 * @property-read \App\Model\BankAccount $bankAccountTo
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payment_detail
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TransferPayment whereBankAccountFromId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TransferPayment whereBankAccountToId($value)
 */
	class TransferPayment extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Truck
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $plate_number
 * @property string $inspection_date
 * @property string $driver
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck wherePlateNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereInspectionDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereDriver($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TruckMaintenance[] $maintenanceList
 * @property integer $store_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TruckMaintenance[] $truckMaintenances
 * @property string $type
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereType($value)
 * @property-read \App\Model\Store $store
 */
	class Truck extends \Eloquent {}
}

namespace App\Model{
/**
 * App\TruckMaintenance
 *
 * @property integer $id
 * @property integer $truck_id
 * @property string $maintenance_type
 * @property integer $cost
 * @property integer $odometer
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Truck $truck
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereTruckId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereMaintenanceType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereOdometer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $store_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereDeletedAt($value)
 * @property-read \App\Model\Store $store
 */
	class TruckMaintenance extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Unit
 *
 * @property integer $id
 * @property string $name
 * @property string $symbol
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereSymbol($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property-read mixed $unit_name
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductUnit[] $productUnits
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\WarehouseSection[] $capacityUnits
 */
	class Unit extends \Eloquent {}
}

namespace App\Model{
/**
 * App\UserDetail
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property boolean $allow_login
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereAllowLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereUpdatedAt($value)
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereDeletedAt($value)
 */
	class UserDetail extends \Eloquent {}
}

namespace App\Model{
/**
 * App\VendorTrucking
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $name
 * @property string $address
 * @property string $tax_id
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VendorTrucking whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property-read \App\Model\Store $store
 */
	class VendorTrucking extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Warehouse
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone_num
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $store_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property-read mixed $hid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\WarehouseSection[] $sections
 * @property-read \App\Model\Store $store
 */
	class Warehouse extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\WarehouseSection
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $warehouse_id
 * @property string $name
 * @property string $position
 * @property integer $capacity
 * @property integer $capacity_unit_id
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read mixed $hid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property-read \App\Model\Unit $capacityUnit
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereCapacity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereCapacityUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class WarehouseSection extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Profile $profile
 * @property integer $store_id
 * @property integer $role_id
 * @property integer $profile_id
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereProfileId($value)
 * @property-read \App\Store $store
 * @property-read \App\Role $role
 * @property-read \App\UserDetail $userDetail
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Settings[] $settings
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 */
	class User extends \Eloquent {}
}

