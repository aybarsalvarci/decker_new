<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            // Mevcut Alanlar
            "name_en"         => "bail|required|string|min:3|max:255",
            "name_esp"        => "bail|required|string|min:3|max:255",
            "slug_en"         => "bail|nullable|string|min:3|max:255", // Unique kontrolü eklemen önerilir: |unique:categories,slug_en
            "slug_esp"        => "bail|nullable|string|min:3|max:255",
            'description_en'  => "bail|nullable|string|max:255",
            'description_esp' => "bail|nullable|string|max:255",
            "image"           => "bail|required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048",

            "icons"           => "bail|nullable|array",

            "icons.*.class"    => "bail|required_with:icons|string|max:100",
            "icons.*.text_en"  => "bail|required|string|max:150",
            "icons.*.text_esp" => "bail|required|string|max:150",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug_en' => $this->slug_en ? Str::slug($this->slug_en) : Str::slug($this->name_en),
            'slug_esp' => $this->slug_esp ? Str::slug($this->slug_esp) : Str::slug($this->name_esp),
        ]);
    }

    public function attributes()
    {
        return [
            'name_en'          => 'English Name',
            'name_esp'         => 'Spanish Name',
            'image'            => 'Category Image',
            'icons.*.class'    => 'Icon Class',
            'icons.*.text_en'  => 'Icon English Text',
            'icons.*.text_esp' => 'Icon Spanish Text',
        ];
    }
}
