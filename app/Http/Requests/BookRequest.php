<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'publishers' => 'required|array',
            'publishers.*' => 'exists:publishers,id',
            'series' => 'nullable|array',
            'series.*' => 'exists:series,id',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
            'editions' => 'nullable|array',
            'editions.*' => 'exists:editions,id',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'country_id.required' => 'El campo país es obligatorio.',
            'authors.required' => 'Debes seleccionar al menos un autor.',
            'authors.*.exists' => 'Algunos autores seleccionados no existen.',
            'title.required' => 'El campo título es obligatorio.',
            'published_at.required' => 'El campo fecha de publicación es obligatorio.',
            'publishers.required' => 'Debes seleccionar al menos un editorial.',
            'publishers.*.exists' => 'Algunos editores seleccionados no existen.',
            // Añade otros mensajes personalizados según las reglas definidas
        ];
    }

}
