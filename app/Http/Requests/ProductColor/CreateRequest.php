<?php

namespace App\Http\Requests\ProductColor;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|unique:product_colors,name',
            'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
