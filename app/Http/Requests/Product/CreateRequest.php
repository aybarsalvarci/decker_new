<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'colors' => 'nullable|array',
            'colors.*' => 'integer|exists:product_colors,id',

            'name_en' => 'required|string|min:3|max:255',
            'slug_en' => 'nullable|string|min:3|max:255',
            'description_en' => 'required|string|min:3',

            'name_esp' => 'required|string|min:3|max:255',
            'slug_esp' => 'nullable|string|min:3|max:255',
            'description_esp' => 'required|string|min:3',

            'isSized' => 'required|boolean',
            'size' => 'required_if:isSized,1|nullable|string|max:255',
            'actual_size' => 'required_if:isSized,1|nullable|string|max:255',
            'weight' => 'nullable|string|max:255',

            'isPriceable' => 'required|boolean',

            'images' => 'required|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:8096',
        ];
    }


    public function messages(): array
    {
        return [
            'size.required_if' => 'If "Has Technical Specs" is checked, the general size field is required.',
            'actual_size.required_if' => 'If "Has Technical Specs" is checked, the actual size field is required.',
            'images.required' => 'At least one product image is required.',
        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'isSized' => $this->has('isSized') ? (bool)$this->isSized : false,
            'isPriceable' => $this->has('isPriceable') ? (bool)$this->isPriceable : false,
        ]);
    }
}
