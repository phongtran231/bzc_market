<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductAttributeGroupRequest extends FormRequest
{
    public function authorize()
    {
        return auth(Admin::GUARD_NAME)->check();
    }

    public function rules(): array
    {
        return [
            'group_name' => [
                'required',
                'unique:product_attribute_groups,group_name',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'group_name.required' => 'Tên nhóm cấu hình không được để trống',
            'group_name.unique' => 'Tên nhóm cấu hình đã tồn tại',
        ];
    }
}
