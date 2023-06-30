<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Validation\Rule;
use App\Models\Tenant\Almacenes\Servicio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServicioRequest extends FormRequest
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
                Rule::unique(Servicio::class,'nombre')->ignore($this->id)
            ],
            'precio'=>[
                'required',
                'numeric'
            ],
            'estado_alquiler'=>[
                'required'
            ]
        ];
    }
    public function messages(){
        return [
            "nombre.required"=> 'El nombre es obligatorio.',
            'nombre.unique' => 'Este servicio ya fue registrado.',
            'precio.required'=> 'Precio es obligatorio.',
            'precio.numeric' => 'Solo se permite numeros decimales o enteros.',
            'estado_alquiler'=>'Seleccione un alquiler.'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Campos obligatorios',
            'errors'   => $validator->errors()
        ]));
    }
}