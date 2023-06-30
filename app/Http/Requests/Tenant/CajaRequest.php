<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Validation\Rule;
use App\Models\Tenant\Caja\Caja;
use Illuminate\Foundation\Http\FormRequest;

class CajaRequest extends FormRequest
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
                Rule::unique(Caja::class,'nombre')->ignore($this->id)
            ]
        ];
    }
    public function messages(){
        return [
            'nombre.required'=>'Nombre de caja es obligatorio.',
            'nombre.unique'=>'Ya existe una caja con este nombre.'
        ];
    }
}
