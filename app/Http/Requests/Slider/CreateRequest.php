<?php

namespace App\Http\Requests\Slider;

use App\Models\Slider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'type' => "required",
            'image_file' => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'video_url' => "nullable|url",
            'order' => 'nullable|integer',
        ];
    }
}
