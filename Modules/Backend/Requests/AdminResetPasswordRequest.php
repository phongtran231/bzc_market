<?php

namespace Modules\Backend\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminResetPasswordRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|string|exists:admins,user_name',
            'secret_key' => 'required|string',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'user_name.required' => 'Vui lòng nhập tên đăng nhập',
            'user_name.string' => 'Sai định dạng tên đăng nhập',
            'user_name.exists' => 'Không tìm thấy tên đăng nhập',
            'secret_key.required' => 'Vui lòng nhập mã bảo mật',
            'secret_key.string' => 'Sai định dạng mã bảo mật',
        ];
    }
}
