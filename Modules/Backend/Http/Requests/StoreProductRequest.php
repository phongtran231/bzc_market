<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return (auth(Admin::GUARD_NAME)->check());
    }

    public function rules()
    {
        return [
            "type" => [
                "string",
            ],
            "parent_id" => [
                "numeric",
                "exists:products,parent_id"
            ],
            "title" => [
                "string"
            ],
            "des" => [
                "string"
            ],
            "sku" => [
                "required",
                "string",
                "unique:products,sku"
            ],
            "price" => [
                "numeric",
            ],
            "image" => [
                "string"
            ],
            "content" => [
                "string"
            ]
        ];
    }
}
