<?php

namespace Platform\Ecommerce\Http\Requests;

use Platform\Support\Http\Requests\Request;

class ProductUpdateOrderByRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|numeric',
        ];
    }
}
