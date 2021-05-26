<?php
namespace Theme\Main\Http\Requests;

use Platform\Base\Enums\BaseStatusEnum;
use Platform\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ContactRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'      => 'required',
            'phone'     => 'required|numeric',
            'subject'   => 'required',
            'message'   => 'required',
            'email'     => 'required|email',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'     => 'Họ và tên không được bỏ trống',
            'phone.required'    => 'Số điện thoại không được bỏ trống',
            'phone.numeric'     => 'Số điện thoại không hợp lệ',
            'subject.required'  => 'Chủ đề không được bỏ trống',
            'email.required'    => 'Email không được bỏ trống',
            'email.email'       => 'Email sai định dạng',
            'message.required'  => 'Nội dung liên hệ không được bỏ trống',
        ];
    }
}
