<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{

    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'user_name' => [
                'required',
            ],
            'password' => [
                'required',
            ]
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Vui lòng nhập tên đăng nhập',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ];
    }
}
