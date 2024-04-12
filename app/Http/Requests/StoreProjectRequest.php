<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:projects,title|string|max:50',
            'slug' => "nullable|string|max:50",
            "description" => "nullable|string",
            "github_url" => "nullable|string|max:150",
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => ['required', 'exists:technologies,id'],
            "image" => "nullable|image",
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo deve massimo di 50 caratteri',

            'slug.max' => 'Lo slug deve massimo di 50 caratteri',

            'description.string' => 'La descrizione deve essere una stringa',

            'github_url.string' => "L'url deve massimo di 150 caratteri",

            'image_preview.string' => "L'url deve massimo di 150 caratteri",

            'type.exists' => 'La tipologia inserita non è valida',

            'technologies.required' => 'La tecnologia è obbligatoria',

            'technologies.exists' => 'La tecnologia inserita non è valida'


        ];
    }
}
