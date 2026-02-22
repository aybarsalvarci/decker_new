<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
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
        $rules = [
            // Hero Section
            'hero_label_en' => 'required|string|max:255',
            'hero_label_esp' => 'required|string|max:255',
            'hero_title_en' => 'required|string|max:255',
            'hero_title_esp' => 'required|string|max:255',
            'hero_desc_en' => 'nullable|string|max:1000', // Açıklamalar boş olabilir
            'hero_desc_esp' => 'nullable|string|max:1000',

            // Vision Section (YENİ EKLENDİ)
            'vision_en' => 'nullable|string|max:1000',
            'vision_esp' => 'nullable|string|max:1000',

            // Story Section
            'story_title_en' => 'required|string|max:255',
            'story_title_esp' => 'required|string|max:255',
            'story_subtitle_en' => 'nullable|string|max:255',
            'story_subtitle_esp' => 'nullable|string|max:255',
            'story_content_en' => 'nullable|string',
            'story_content_esp' => 'nullable|string',
            'story_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',

            // Factory Section Headers (YENİ EKLENDİ)
            // Bu alanlar opsiyonel olabilir, sadece liste kullanmak isteyebilirsiniz.
            'factory_title_en' => 'nullable|string|max:255',
            'factory_title_esp' => 'nullable|string|max:255',
            'factory_desc_en' => 'nullable|string|max:1000',
            'factory_desc_esp' => 'nullable|string|max:1000',

            // Values Main Titles
            'values_title_en' => 'nullable|string|max:255',
            'values_title_esp' => 'nullable|string|max:255',
            'values_subtitle_en' => 'nullable|string|max:255',
            'values_subtitle_esp' => 'nullable|string|max:255',
        ];

        // Statistics Loop
        for ($i = 1; $i <= 4; $i++) {
            $rules["stat_{$i}_num"] = 'nullable|string|max:50';
            $rules["stat_{$i}_text_en"] = 'nullable|string|max:255';
            $rules["stat_{$i}_text_esp"] = 'nullable|string|max:255';
        }

        // Values Loop
        for ($i = 1; $i <= 3; $i++) {
            $rules["val_{$i}_icon"] = 'nullable|string|max:100';
            $rules["val_{$i}_title_en"] = 'nullable|string|max:255';
            $rules["val_{$i}_title_esp"] = 'nullable|string|max:255';
            $rules["val_{$i}_desc_en"] = 'nullable|string|max:1000';
            $rules["val_{$i}_desc_esp"] = 'nullable|string|max:1000';
        }

        return $rules;
    }


    public function attributes()
    {
        $attributes = [
            'hero_label_en' => 'Hero Label (English)',
            'hero_label_esp' => 'Hero Label (Spanish)',
            'story_image' => 'Story Side Image',
            'vision_en' => 'Vision Text (English)',
            'vision_esp' => 'Vision Text (Spanish)',
            'factory_title_en' => 'Factory Section Title (English)',
        ];

        for ($i = 1; $i <= 4; $i++) {
            $attributes["stat_{$i}_num"] = "Statistic #{$i} Number";
        }

        return $attributes;
    }
}
