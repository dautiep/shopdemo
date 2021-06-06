<?php

namespace Platform\CartDetail\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Platform\Base\Traits\EnumCastable;
use Platform\Base\Enums\BaseStatusEnum;
use Platform\Base\Models\BaseModel;
use Platform\Ecommerce\Models\Product;

class CartDetail extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cart_details';

    /**
     * @var array
     */
    protected $fillable = [
        'cart_id',
        'quantity',
        'product_id',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    public static function saveDetailCart($input)
    {
        $cartDetail = new CartDetail();
        $cartDetail->cart_id = $input['cartId'];
        $cartDetail->quantity = $input['quantityProduct'];
        $cartDetail->product_id = $input['productId'];
        $cartDetail->save();
        return $cartDetail;
    }

    public static function getDetailcart($cartId, $productId)
    {
        return CartDetail::where('cart_id', $cartId)
                    ->where('product_id', $productId)->first();
    }

    public static function getDetailCartById($input)
    {
        return CartDetail::where('id', $input['detail_cart_id'])->first();
    }

    public static function updateDetailCart($input)
    {
        $cartDetail = CartDetail::where('cart_id', $input['cartId'])
                    ->where('product_id', $input['productId'])->first();
        $cartDetail->quantity = $cartDetail->quantity + $input['quantityProduct'];
        $cartDetail->save();
        return $cartDetail;
    }

    public function getProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public static function getDetailCartByCardId($cartId)
    {
        return CartDetail::where('cart_id', $cartId)->get();
    }

    public static function updateQuantity($input)
    {
        $cartDetail = CartDetail::where('id', $input['cart_detail_id'])->first();
        if (!empty($cartDetail)) {
            $cartDetail->quantity = $input['cart_detail_quantity'];
            $cartDetail->save();
            return $cartDetail;
        }
    }

    public static function deleteCartDetail($id)
    {
        return CartDetail::where('id', $id)->delete();
    }
}
