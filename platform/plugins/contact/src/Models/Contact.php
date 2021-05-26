<?php

namespace Platform\Contact\Models;

use Platform\Base\Traits\EnumCastable;
use Platform\Contact\Enums\ContactStatusEnum;
use Platform\Base\Models\BaseModel;

class Contact extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'subject',
        'content',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => ContactStatusEnum::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(ContactReply::class);
    }

    public static function saveContact($input)
    {
        $contact = new Contact();
        $contact->name = $input['name'];
        $contact->email = $input['email'];
        $contact->phone = $input['phone'];
        $contact->subject = $input['subject'];
        $contact->content = $input['message'];
        $contact->save();
        return $contact;
    }
}
