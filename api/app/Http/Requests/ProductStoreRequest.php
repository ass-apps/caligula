<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "categoryId" => "required|exists:categories,id",
            "brandId" => "required|exists:brands,id",
            "image" => "required",
            "description" => "required",
            "variations" => "required|array|min:1"
        ];
    }
}
