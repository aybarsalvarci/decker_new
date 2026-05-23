<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class CreateInfoRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'location' => 'required|string|max:500',
            'working_hours' => 'required|string|max:255',
            'map' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!str_contains($value, '<iframe') || !str_contains($value, '</iframe>')) {
                    $fail('The ' . $attribute . ' must be a valid Google Maps iframe code.');
                }
            }],
        ];
    }
}
