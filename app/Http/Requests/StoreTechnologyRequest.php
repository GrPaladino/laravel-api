<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechnologyRequest extends FormRequest
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
            'label' => 'required|string|max:40',
            'color' => "required|string|max:7"
        ];
    }

    public function messages()
    {
        return [
            'label.required' => 'Il nome è obbligatorio',
            'label.string' => 'Il nome deve essere una stringa',
            'label.max' => 'Il nome deve massimo di 40 caratteri',

            'color.required' => 'Il colore è obbligatorio',
            'color.max' => 'Lo colore deve massimo di 7 caratteri'

        ];
    }
}
