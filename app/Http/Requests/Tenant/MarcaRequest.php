<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Validation\Rule;
use App\Models\Tenant\Almacenes\Marca;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MarcaRequest extends FormRequest
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
            'nombre'=>[
                'required',
                Rule::unique(Marca::class,'nombre')->ignore($this->id)
            ],
            'procedencia'=>[
                'required'
            ]
        ];
    }
    public function messages(){
        return [
            'nombre.required'=>'Nombre de la marca es requerido.',
            'nombre.unique'=>'Ya hay una marca con este nombre.'
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
