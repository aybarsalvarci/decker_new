<?php

namespace App\Http\Requests\ProductColor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $id = $this->route('product_color');

        return [
            'name' => ['bail', 'required', 'string', Rule::unique('product_colors', 'name')->ignore($id)],
            'image' => 'bail|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
