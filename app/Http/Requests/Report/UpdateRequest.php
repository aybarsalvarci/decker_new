<?php

namespace App\Http\Requests\Report;

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
            'title_en' => 'required|string|max:255',
            'title_esp' => 'required|string|max:255',
            'slug_en' => 'nullable|string|max:255',
            'slug_esp' => 'nullable|string|max:255',
            'content_en' => 'required|string',
            'content_esp' => 'required|string',
            'type' => 'required|string|in:news,exhibition',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'old_images' => 'nullable|array|max:10',
            'old_images.*' => 'exists:report_images,id',
        ];
    }
}
