<?php

namespace Platform\Ecommerce\Models;

use Platform\Base\Supports\Avatar;
use Platform\Ecommerce\Notifications\CustomerResetPassword;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Platform\Cart\Models\Cart;
use RvMedia;

/**
 * @mixin \Eloquent
 */
class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'ec_customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'phone',
        'dob',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPassword($token));
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? RvMedia::getImageUrl($this->avatar, 'thumb') : (string)(new Avatar)->create($this->name)->toBase64();
    }

    /**
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class, 'customer_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'ec_discount_customers', 'customer_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'customer_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Customer $customer) {
            $customer->discounts()->detach();
            Review::where('customer_id', $customer->id)->delete();
            Wishlist::where('customer_id', $customer->id)->delete();
        });
    }

    public static function saveCustomer($input)
    {
        $customer = new Customer();
        $customer->name = $input['nameCustomer'];
        $customer->email = $input['emailCustomer'];
        $customer->password = Hash::make($input['passwordCustomer']);
        $customer->phone = $input['phoneCustomer'];
        $customer->save();
        return $customer;
    }

    public function getCart(): HasOne
    {
        return $this->hasOne(Cart::class, 'customer_id', 'id');
    }

    public static function checkEmailExist($email)
    {
        return Customer::where('email', $email)->first();
    }

    public static function getCustomerById($customerId)
    {
        return Customer::where('id', $customerId)->first();
    }

    public static function updatePassword($input, $customerId)
    {
        $user = Customer::where('id', $customerId)->first();
        $user->password = Hash::make($input['passwordCustomer']);
        $user->save();
        return $user;
    }

}
