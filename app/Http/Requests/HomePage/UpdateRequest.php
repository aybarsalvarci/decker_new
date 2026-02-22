<?php

namespace App\Http\Requests\HomePage;

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
            'topVideoTitle_en'      => 'required|string|max:150',
            'topVideoTitle_esp'     => 'required|string|max:150',

            'topVideoDesc_en'       => 'required|string|max:255',
            'topVideoDesc_esp'      => 'required|string|max:255',

            'iframeVideo'           => 'required|string|max:1000',

            'homePageAboutTitle_en' => 'required|string|max:150',
            'homePageAboutTitle_esp'=> 'required|string|max:150',

            'homePageAboutDesc_en'  => 'required|string|max:1000',
            'homePageAboutDesc_esp' => 'required|string|max:1000',

            'topVideo'              => 'nullable|file|mimes:mp4,mov,ogg|max:20480',
        ];
    }
}
