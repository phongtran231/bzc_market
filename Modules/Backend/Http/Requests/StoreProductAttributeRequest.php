<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return auth(Admin::GUARD_NAME)->check();
    }

    public function rules(): array
    {
        return [
            'label' => [
                'required',
                'unique:product_attributes,label',
            ],
            'key' => [
                'required',
                'unique:product_attributes,key',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'label.required' => 'Tên thuộc tính không được để trống',
            'label.unique' => 'Tên thuộc tính đã tồn tại',
            'key.required' => 'Khóa thuộc tính không được để trống',
            'key.unique' => 'Khóa thuộc tính đã tồn tại',
        ];
    }
}
