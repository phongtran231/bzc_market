<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class AdminResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return auth(Admin::GUARD_NAME)->check();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'current_password' => [
                'required',
            ],
            'new_password' => [
                'required',
                'min:8'
            ],
            'confirm_password' => [
                'required',
                'same:new_password',
            ]
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'current_password.required' => 'Mật khẩu không được để trống',
            'new_password.required' => 'Mật khẩu mới không được để trống',
            'new_password.min' => 'Mật khẩu mới ít nhất 8 kí tự',
            'confirm_password.required' => 'Mật khẩu nhập lại không được để trống',
            'confirm_password.same' => 'Mật khẩu nhập lại không trùng',
        ];
    }
}
