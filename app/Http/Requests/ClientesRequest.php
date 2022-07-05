<?php

namespace App\Http\Requests;

use App\Http\Controllers\Admin\ClientesCrudController;
use App\Models\Clientes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientesRequest extends FormRequest
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
            'nombre_comercial' => 'required|unique:App\Models\Clientes,nombre_comercial',
            'razon_social' => 'required',
            'colonia' => 'required',
            'email' => 'required|email',
            'pais_id' => 'required',
            'estado_id' => 'required',
            'municipio_id' => 'required',
            'grupo_cliente_id' => 'required|numeric',
            'calle' => 'required',
            'numero_exterior' => 'required|numeric',
            'numero_interior' => 'numeric|nullable',
            'codigo_postal' => 'required|numeric',
            'estatus' => 'required',



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
            //
        ];
    }
}
