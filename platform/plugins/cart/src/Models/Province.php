<?php

namespace Platform\Cart\Models;
use Platform\Base\Models\BaseModel;
use Platform\Base\Traits\EnumCastable;
class Province extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tinh';

    public static function getAll()
    {
        return Province::all();
    }
}
