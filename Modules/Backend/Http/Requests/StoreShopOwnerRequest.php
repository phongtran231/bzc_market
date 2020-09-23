<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreShopOwnerRequest extends FormRequest
{

    public function authorize()
    {
        return auth(Admin::GUARD_NAME)->check();
    }

    public function rules(): array
    {
        return [
            'full_name' => [
                'string',
                'required',
            ],
            'phone' => [
                'required',
                'regex:/^0+\d{9}$/m',
                'unique:shop_owners,phone'
            ],
            'email' => [
                'required',
                'email',
                'unique:shop_owners,email'
            ],
            'address' => [
                'string'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.string' => 'Vui lòng nhập đúng họ tên',
            'full_name.required' => 'Họ và tên không được để trống',
            'phone.required' => 'Số điện thoại cần khai báo',
            'phone.numeric' => 'Số điện thoại chỉ nhập số',
            'phone.unique' => 'Đã có người đăng ký bằng số điện thoại này',
            'phone.regex' => 'Số điện thoại sai định dạng',
            'email.required' => 'Vui lòng điền Email',
            'email.email' => 'Vui lòng nhập đúng email. Eg: john@example.com',
            'email.unique' => 'Email đã có người đăng ký',
        ];
    }
}
