<?php

namespace App\Http\Requests\FreeSamples;

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
            'sample_box_id' => 'required|exists:free_sample_boxes,id',
            'full_name' => "required|string|min:3|max:50",
            'email' => "required|email|min:3|max:50",
            'phone' => "required|string",
            'state' => "required|string",
            'town_select' => "required|string",
            'town_custom' => "nullable|string",
            "address" => "required|string",
        ];
    }
}
