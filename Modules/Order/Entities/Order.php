<?php

namespace Modules\Order\Entities;

use Modules\Support\Money;
use Modules\Support\State;
use Modules\Support\Country;
use Modules\Tax\Entities\TaxRate;
use Illuminate\Support\Facades\DB;
use Modules\Coupon\Entities\Coupon;
use Modules\Order\Admin\OrderTable;
use Modules\Support\Eloquent\Model;
use Modules\Payment\Facades\Gateway;
use Modules\Shipping\Facades\ShippingMethod;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Transaction\Entities\Transaction;
use Modules\User\Entities\User;

class Order extends Model
{
    use SoftDeletes;

    const CANCELED = 'canceled';
    const COMPLETED = 'completed';
    const ON_HOLD = 'on_hold';
    const PENDING = 'pending';
    const PENDING_PAYMENT = 'pending_payment';
    const PROCESSING = 'processing';
    const REFUNDED = 'refunded';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date', 'deleted_at'];

    public static function totalSales()
    {
        return Money::inDefaultCurrency(self::sum('total'));
    }

    public function status()
    {
        return trans("order::statuses.{$this->status}");
    }

    public function hasShippingMethod()
    {
        return ! is_null($this->shipping_method);
    }

    public function hasCoupon()
    {
        return ! is_null($this->coupon);
    }

    public function hasTax()
    {
        return $this->taxes->isNotEmpty();
    }

    public static function salesAnalytics()
    {
        return static::selectRaw('SUM(total) as total')
            ->selectRaw('COUNT(*) as total_orders')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('EXTRACT(DAY FROM created_at) as day')
            ->groupBy(DB::raw('EXTRACT(DAY FROM created_at)'))
            ->orderby('day')
            ->get();
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class)->withTrashed();
    }

    public function taxes()
    {
        return $this->belongsToMany(TaxRate::class, 'order_taxes')
            ->using(OrderTax::class)
            ->as('order_tax')
            ->withPivot('amount')
            ->withTrashed();
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class)->withTrashed();
    }

    public function getSubTotalAttribute($subTotal)
    {
        return Money::inDefaultCurrency($subTotal);
    }

    public function getShippingCostAttribute($shippingCost)
    {
        return Money::inDefaultCurrency($shippingCost);
    }

    public function getDiscountAttribute($discount)
    {
        return Money::inDefaultCurrency($discount);
    }

    public function getTaxAttribute($tax)
    {
        return Money::inDefaultCurrency($tax);
    }

    public function getTotalAttribute($total)
    {
        return Money::inDefaultCurrency($total);
    }

    /**
     * Get the order's shipping method.
     *
     * @param string $shippingMethod
     * @return string
     */
    public function getShippingMethodAttribute($shippingMethod)
    {
        return ShippingMethod::get($shippingMethod)->label ?? '';
    }

    /**
     * Get the order's payment method.
     *
     * @param string $paymentMethod
     * @return string
     */
    public function getPaymentMethodAttribute($paymentMethod)
    {
        return Gateway::get($paymentMethod)->label ?? '';
    }

    public function getCustomerFullNameAttribute()
    {
        return "{$this->customer_first_name} {$this->customer_last_name}";
    }

    public function getBillingFullNameAttribute()
    {
        return "{$this->billing_first_name} {$this->billing_last_name}";
    }

    public function getShippingFullNameAttribute()
    {
        return "{$this->shipping_first_name} {$this->shipping_last_name}";
    }

    public function getBillingCountryNameAttribute()
    {
        return Country::name($this->billing_country);
    }

    public function getShippingCountryNameAttribute()
    {
        return Country::name($this->shipping_country);
    }

    public function getBillingStateNameAttribute()
    {
        return State::name($this->billing_country, $this->billing_state);
    }

    public function getShippingStateNameAttribute()
    {
        return State::name($this->shipping_country, $this->shipping_state);
    }

    public function storeProducts($cartItem)
    {
        $custom_design_image = NULL;

        if($cartItem->custom_design_image && !empty($cartItem->custom_design_image)){

            $temp_file_name = basename($cartItem->custom_design_image);

            $old_path = public_path('tmp/'.$temp_file_name);
            if(file_exists($old_path)){
                $new_path = public_path('order_images/'.$temp_file_name);
                \File::move($old_path, $new_path);
                $custom_design_image = $temp_file_name;
            }
        }
        $temp_user_ids = [];
        if(auth()->user()->hasRoleId(3)){

            $already_generated_cards = User::where('password','=','nopassword')->whereNull('order_id')->orderby('id','asc')->limit($cartItem->qty)->get()->toArray();
            for ($i=0;$i<$cartItem->qty;$i++){
                if(isset($already_generated_cards[$i])){
                    $temp_user_row = $already_generated_cards[$i];

                    $temp_user_data = [];
                    $temp_user_data['username'] = 'slack.user.'.auth()->user()->id.'.'.$temp_user_row['id'];
                    $temp_user_data['first_name'] = 'NULL';
                    $temp_user_data['last_name'] = 'NULL';
                    $temp_user_data['email'] = 'NULL';
                    $temp_user_data['password'] = 'nopassword';
                    $temp_user_data['parent_id'] = auth()->user()->id;
                    $temp_user_data['order_id'] = $this->id;
                    User::whereId($temp_user_row['id'])->update($temp_user_data);
                    $temp_user_ids[] = $temp_user_row['id'];
                }else{
                    $temp_user_data = [];
                    $temp_user_data['username'] = 'slack.user.'.auth()->user()->id;
                    $temp_user_data['first_name'] = 'NULL';
                    $temp_user_data['last_name'] = 'NULL';
                    $temp_user_data['email'] = 'NULL';
                    $temp_user_data['password'] = 'nopassword';
                    $temp_user_data['parent_id'] = auth()->user()->id;
                    $temp_user_data['order_id'] = $this->id;

                    $last_inserted_id = User::insertGetId($temp_user_data);
                    $final_username = $temp_user_data['username'].'.'.$last_inserted_id;
                    User::whereId($last_inserted_id)->update(['username'=>$final_username]);
                    $temp_user_ids[] = $last_inserted_id;
                }
            }

        }

        $orderProduct = $this->products()->create([
            'product_id' => $cartItem->product->id,
            'unit_price' => $cartItem->unitPrice()->amount(),
            'qty' => $cartItem->qty,
            'custom_image' => $custom_design_image,
            'line_total' => $cartItem->total()->amount(),
            'associate_users' => json_encode($temp_user_ids),

        ]);
        $orderProduct->storeOptions($cartItem->options);
    }

    public function attachTax($cartTax)
    {
        $this->taxes()->attach($cartTax->id(), ['amount' => $cartTax->amount()->amount()]);
    }

    public function storeTransaction($response)
    {
        if (is_null($response->getTransactionReference())) {
            return;
        }

        $this->transaction()->create([
            'transaction_id' => $response->getTransactionReference(),
            'payment_method' => $this->getOriginal('payment_method'),
        ]);
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        $query = $this->newQuery()
            ->select([
                'id',
                'customer_first_name',
                'customer_last_name',
                'customer_email',
                'currency',
                'total',
                'status',
                'created_at',
            ]);

        return new OrderTable($query);
    }
}
