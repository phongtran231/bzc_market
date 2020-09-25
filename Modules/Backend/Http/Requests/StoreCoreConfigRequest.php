<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreCoreConfigRequest extends FormRequest
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
            'key_name' => [
                'required',
                'unique:core_configs,key_name',
                'string',
                'min:5'
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'key_name.required' => 'Thiếu tên cấu hình',
            'key_name.unique' => 'Tên cấu hình đã tồn tại',
            'key_name.string' => 'Tên cấu hình phải là chữ',
            'key_name.min' => 'Tên cấu hình quá ngắn',
        ];
    }
}
