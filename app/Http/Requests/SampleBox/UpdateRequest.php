<?php

namespace App\Http\Requests\SampleBox;

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
            'title_en' => 'required|string|max:60',
            'title_esp' => 'required|string|max:60',
            'description_en' => 'required|string|max:300',
            'description_esp' => 'required|string|max:300',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ];
    }

    public function attributes(): array
    {
        return [
            'title_en' => 'Title(English)',
            'title_esp' => 'Title(Spanish)',
            'description_en' => 'Description(English)',
            'description_esp' => 'Description(Spanish)',
            'image' => 'Image',
        ];
    }
}
