<?php
namespace Theme\Main\Http\Requests;
use Platform\Base\Enums\BaseStatusEnum;
use Platform\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'nameCustomer' => 'required',
            'emailCustomer' => 'required|email|unique:ec_customers,email',
            'phoneCustomer' => 'required',
            'passwordCustomer' =>'required|min:8',
            'passwordCustomerConfirm' =>'required|same:passwordCustomer',

        ];
        return $rule;
    }

    public function messages(){

        return [
            'nameCustomer.required' => 'Vui lòng nhập tên của bạn!',
            'emailCustomer.required' => 'Vui lòng nhập địa chỉ email của bạn!',
            'emailCustomer.email' => 'Địa chỉ email không hợp lệ1',
            'emailCustomer.unique' => 'Địa chỉ email đã được đăng ký! Vui lòng kiểm tra lại!',
            'phoneCustomer.required' => 'Vui lòng nhập số điện thoại của bạn!',
            'passwordCustomer.required' => 'Vui lòng điền mật khẩu!',
            'passwordCustomer.min' => 'Mật khẩu phải có it nhất 8 ký tự!',
            'passwordCustomerConfirm.required' => 'Vui lòng xác thực mật khẩu!',
            'passwordCustomerConfirm.same' => 'Xác thực mật khẩu không đúng Vui lòng kiểm tra lại!'
        ];
    }
}
