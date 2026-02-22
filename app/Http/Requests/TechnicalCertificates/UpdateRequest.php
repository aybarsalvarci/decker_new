<?php

namespace App\Http\Requests\TechnicalCertificates;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            "title_en" => "required|string|min:3|max:50",
            "title_esp" => "required|string|min:3|max:50",
            "desc_en" => "required|string|min:3|max:500",
            "desc_esp" => "required|string|min:3|max:500",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048",
        ];
    }
}
