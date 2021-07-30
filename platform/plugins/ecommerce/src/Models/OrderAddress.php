<?php

namespace Platform\Ecommerce\Models;

use Platform\Base\Models\BaseModel;
use Platform\Base\Supports\Avatar;
use Platform\Base\Supports\Helper;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Platform\Cart\Models\Province;

class OrderAddress extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'ec_order_addresses';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'address',
        'zip_code',
        'order_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return string
     */
    public function getCountryNameAttribute()
    {
        return Helper::getCountryNameByCode($this->country);
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        return (string)(new Avatar)->create($this->name)->toBase64();
    }

    public static function saveOrderAddress($input)
    {
        $order =  Order::where('id', $input['orderId'])->first();
        if (!empty($order)) {
            $orderAddress = new OrderAddress();
            $orderAddress->name = auth('customer')->user()->name;
            $orderAddress->phone = auth('customer')->user()->phone;
            $orderAddress->email = auth('customer')->user()->email;
            $orderAddress->address = $input['addressOrder'];
            $orderAddress->city = $input['cityOrder'];
            $orderAddress->order_id = $order->id;
            $orderAddress->save();
            return $orderAddress;
        }
    }

    public function getProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'city', 'id');
    }

    public static function getOrderAddress($orderId)
    {
        return OrderAddress::where('order_id', $orderId)->first();
    }
}
