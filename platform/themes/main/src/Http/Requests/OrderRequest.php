<?php
namespace Theme\Main\Http\Requests;

use Platform\Support\Http\Requests\Request;

class OrderRequest extends Request
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'firstname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'address' => 'required',
            'city' =>'required',
        ];
        return $rule;
    }

    public function messages(){

        return [
            'firstname.required' => 'Vui lòng nhập tên của bạn!',
            'email.required' => 'Vui lòng nhập địa chỉ email của bạn!',
            'email.email' => 'Địa chỉ email không hợp lệ1',
            'phone.required' => 'Vui lòng nhập số điện thoại của bạn!',
            'address.required' => 'Vui lòng nhập địa chỉ của bạn!',
            'city.required' => 'Vui lòng chọn tỉnh thành!'
        ];
    }
}
