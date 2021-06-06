<?php

namespace Platform\Cart\Models;

use Platform\Base\Traits\EnumCastable;
use Platform\Base\Enums\BaseStatusEnum;
use Platform\Base\Models\BaseModel;
use Platform\Ecommerce\Models\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Platform\CartDetail\Models\CartDetail;

class Cart extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carts';

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    public  static function saveCart($input)
    {
        $cart = new Cart();
        $cart->customer_id = $input['customerId'];
        $cart->save();
        return $cart;
    }

    public function getCustomer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function getDetailcart(): HasMany
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'id');
    }
}
