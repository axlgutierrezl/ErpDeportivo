<?php

namespace App\Http\Requests\Tenant;

use App\Models\Tenant\Almacenes\Almacen;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AlmacenRequest extends FormRequest
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
            'descripcion' => [
                'required',
                Rule::unique(Almacen::class, 'descripcion')->ignore($this->id),
            ],
            'ubicacion' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'descripcion.required' => 'Ingrese el nombre de almacen.',
            'descripcion.unique' => 'Ya hay un registro con este nombre',
            'ubicacion.required' => 'Ingrese la ubicacion de almacen.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Campos obligatorios',
            'errors' => $validator->errors(),
        ]));
    }
}