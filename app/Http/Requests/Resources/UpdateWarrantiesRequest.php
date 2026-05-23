<?php

namespace App\Http\Requests\Resources;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarrantiesRequest extends FormRequest
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
            'title_en'    => 'required|string|max:255',
            'content_en'  => 'required|string',

            'title_esp'   => 'required|string|max:255',
            'content_esp' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'title_en'    => 'Page Title (English)',
            'title_esp'   => 'Page Title (Spanish)',
            'content_en'  => 'Main Content (English)',
            'content_esp' => 'Main Content (Spanish)',
        ];
    }
}
