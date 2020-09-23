<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCoreConfigRequest extends FormRequest
{

    /**
     * @return bool
     */
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
            'value' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'value.required' => 'Thiếu giá trị cấu hình',
        ];
    }
}
