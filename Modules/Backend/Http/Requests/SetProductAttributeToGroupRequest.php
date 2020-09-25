<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class SetProductAttributeToGroupRequest extends FormRequest
{
    public function authorize()
    {
        return auth(Admin::class);
    }

    public function rules()
    {
        return [
            'attribute_group_id' => [
                'required',
            ]
        ];
    }

    public function messages()
    {
        return [
            'attribute_group_id.required' => 'Group không được để trống'
        ];
    }
}
