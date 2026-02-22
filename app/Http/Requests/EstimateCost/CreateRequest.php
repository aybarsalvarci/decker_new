<?php

namespace App\Http\Requests\EstimateCost;

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
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:3|max:30',
            'phone' => 'required|string',
            'email' => 'required|email:rfc,dns|max:50',
            'message' => 'required|string|max:255',

            // Ürün listesi kontrolü
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',

            // Boyutlu ürünler için (isSized: true)
            // nullable yaparak eğer değer gelmezse hata vermemesini sağlıyoruz
            'items.*.length' => 'nullable|numeric|min:0',
            'items.*.width' => 'nullable|numeric|min:0',
            'items.*.area' => 'nullable|numeric|min:0',

            // Adetli ürünler için (isSized: false)
            'items.*.qty' => 'nullable|integer|min:1',
        ];
    }

    /**
     * Opsiyonel: Hata mesajlarını özelleştirebilirsin
     */
    public function messages(): array
    {
        return [
            'items.required' => __('estimateCost.validation.items_required'),
            'items.*.product_id.exists' => __('estimateCost.validation.product_not_found'),
        ];
    }
}
