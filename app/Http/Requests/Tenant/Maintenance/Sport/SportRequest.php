<?php

namespace App\Http\Requests\Tenant\Maintenance\Sport;

use App\Models\Tenant\Maintenance\Sport\Sport;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

// CC1: CAMPOS
class SportRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique(Sport::class, 'name')
                    ->where(fn ($query) => $query->where('state', '=', '1'))
                    ->ignore($this->id),
            ],
            // 'description' => [
            //     'required'
            // ],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Ingrese nombre del deporte.',
            'name.unique' => 'Existe un deporte con el mismo nombre',
            // 'description.required' => 'Ingrese una descripcion para el deporte.',
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