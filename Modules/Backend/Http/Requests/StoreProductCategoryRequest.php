<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return auth(Admin::GUARD_NAME)->check();
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'unique:product_categories,title',
            ],
            'cat_name' => [
                'required_if:parent_id,0'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'cat_name.required_if' => 'Tên tiêu đề không được để trống',
        ];
    }
}
