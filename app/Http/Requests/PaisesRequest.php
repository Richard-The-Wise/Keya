<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaisesRequest extends FormRequest
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
             'nombre' => 'required|max:255|unique:App\Models\Paises,nombre',
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
            'nombre.required' => 'Este cuadro es requerido',
            'nombre.max' => 'No se aceptan más de 255 caracteres',
            'nombre.unique' => 'Este país ya existe en el registro',
        ];
    }
}
