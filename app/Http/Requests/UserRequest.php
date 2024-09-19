<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            //'email' => 'required|string|email|max:255|unique:users,email,'.($this->user ? $this->user->id : 'NULL'),
            'password' => 'required|string|min:8|confirmed',
            //'role' => 'required|in:admin,read_only', // Enum values
            'departament' => 'nullable|string|max:100',
            'internal' => 'nullable|string|max:20',
            'cellphone' => 'nullable|string|max:20',
            'note' => 'nullable|string',
            'alternate_email' => 'nullable|email|max:100',
        ];
        if (backpack_user()->role != 'admin') {
            // El usuario de solo lectura no puede cambiar el rol
            unset($rules['role']);
        } else {
            $rules['role'] = 'required|in:admin,read_only';
        }
        if ($user->role != 'read_only' || $user->id != $this->route('user')) {
            // Solo validamos el email si el usuario no es 'read_only' o si está editando su propio perfil
            $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $this->user;
        }
    
        return $rules;

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
            //
        ];
    }
}
