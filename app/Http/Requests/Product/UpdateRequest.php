<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'isPriceable'  => 'required|boolean',
            'isSized'      => 'required|boolean',

            'colors'   => 'nullable|array',
            'colors.*' => 'integer|exists:product_colors,id',

            'name_en'        => 'required|string|min:3|max:255',
            'slug_en'        => 'nullable|string|min:3|max:255',
            'description_en' => 'required|string|min:3',

            'name_esp'        => 'required|string|min:3|max:255',
            'slug_esp'        => 'nullable|string|min:3|max:255',
            'description_esp' => 'required|string|min:3',

            'size'        => 'required_if:isSized,1|nullable|string|max:255',
            'actual_size' => 'required_if:isSized,1|nullable|string|max:255',
            'weight'      => 'nullable|string|max:255',

            'deleted_images'   => 'nullable|array',
            'deleted_images.*' => 'integer|exists:product_images,id',
            'new_images'      => 'nullable|array|max:10',
            'new_images.*'    => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'isSized'     => $this->has('isSized') ? (bool)$this->isSized : false,
            'isPriceable' => $this->has('isPriceable') ? (bool)$this->isPriceable : false,
        ]);
    }


    public function messages(): array
    {
        return [
            'size.required_if'        => 'The general size field is required when technical specs are enabled.',
            'actual_size.required_if' => 'The actual size field is required when technical specs are enabled.',
            'new_images.*.image'      => 'Each uploaded file must be an image.',
            'new_images.*.max'        => 'Images may not be larger than 2MB.',
        ];
    }
}
