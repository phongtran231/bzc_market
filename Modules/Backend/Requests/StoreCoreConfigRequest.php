<?php

namespace Modules\Backend\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoreConfigRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'key_name' => [
                'required',
                'unique:core_config,key_name',
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
            'key_name.required' => 'Vui lòng nhập từ khóa',
            'key_name.unique' => 'Từ khóa đã tồn tại',
            'key_name.string' => 'Từ khóa phải là chữ (a-z)',
            'key_name.min' => 'Từ khóa quá ngắn'
        ];
    }
}
