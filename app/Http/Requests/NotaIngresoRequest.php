<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaIngresoRequest extends FormRequest
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
            'fecha' => ['required'],
            'origen' => ['required','not_in:0'],
            'destino' => ['required','not_in:0'],
            'moneda' => ['required','not_in:0'],
            'detalles'=>['array','min:1']
        ];
    }
    public function messages()
    {
        return [
            'fecha.required' => 'Seleccione una fecha',
            'origen.not_in' => 'Seleccione el origen.',
            'destino.not_in' => 'Seleccione el destino',
            'moneda.not_in' => 'Seleccione una moneda',
            'detalles'=>'El detalle debe tener al menos 1 artículo.'
        ];
    }
}