<?php

namespace App\Http\Requests\Setting;

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
            'site_title_en'   => 'required|string|max:255',
            'site_title_esp'  => 'required|string|max:255',
            'header_logo'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'footer_logo'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'favicon'         => 'nullable|image|mimes:jpeg,png,jpg,webp,ico|max:512',

            'email'           => 'required|email:rfc,dns|max:255',
            'phone_number'    => 'required|string|max:50',
            'address'         => 'required|string|max:500',

            'meta_description_en' => "nullable|string|max:200",
            'meta_description_esp' => "nullable|string|max:200",

            'meta_keywords_en' => "nullable|string|max:200",
            'meta_keywords_esp' => "nullable|string|max:200",

            'footer_address'  => 'nullable|string|max:200',
            'footer_desc_en'  => 'nullable|string|max:1000',
            'footer_desc_esp' => 'nullable|string|max:1000',

            'facebook'        => 'nullable|url|max:255',
            'twitter'         => 'nullable|url|max:255',
            'instagram'       => 'nullable|url|max:255',
        ];
    }


    public function attributes(): array
    {
        return [
            'site_title_en'   => 'Site Title (English)',
            'site_title_esp'  => 'Site Title (Spanish)',
            'phone_number'    => 'Phone Number',
            'address'         => 'Headquarters Address',
            'footer_address'  => 'Footer Address',
            'footer_desc_en'  => 'Footer Description (English)',
            'footer_desc_esp' => 'Footer Description (Spanish)',
        ];
    }
}
