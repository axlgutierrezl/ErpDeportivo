<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Validation\Rule;
use App\Models\Tenant\Almacenes\Categoria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class CategoriaRequest extends FormRequest
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
                Rule::unique(Categoria::class, 'descripcion')->ignore($this->id),
            ],
        ];
    }
    public function messages()
    {
        return [
            'descripcion.required' => 'Ingrese nombre de categoria',
            'descripcion.unique' => 'Esta categoria ya existe.',
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