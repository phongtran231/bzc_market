<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class SetRoleForAdminRequest extends FormRequest
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
            'role_name' => [
                'required',
                'exists:roles,name',
            ],
            'admin_name' => [
                'required',
                'exists:admins,user_name'
            ]
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'role_name.required' => 'Tên role không được để trống',
            'role_name.exists' => 'Tên role không tồn tại',
            'admin_name.required' => 'Tài khoản admin không được để trống',
            'admin_name.exists' => 'Tài khoản không tồn tại',
        ];
    }
}
