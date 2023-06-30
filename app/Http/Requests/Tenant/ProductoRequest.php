<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Validation\Rule;
use App\Models\Tenant\Almacenes\Producto;
use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'almacen_id'=>['required'],
            'categoria_id'=>['required'],
            'marca_id'=>['required'],
            'nombre'=>[
                'required',
                Rule::unique(Producto::class,'nombre')->ignore($this->id)
            ],
            'codigo_barra'=>[
                'nullable',
                'numeric',
                Rule::unique(Producto::class,'codigo_barra')->ignore($this->id)
            ],
            'precio_venta'=>[
                'required',
                'numeric'
            ],
            'precio_compra'=>[
                'required',
                'numeric',
                "max:$this->precio_venta"
            ],
            'stock'=>[
                'required',
                'numeric'
            ],
            'stock_minimo'=>[
                'required',
                'numeric'
            ],
            'unidad_medida'=>[
                'required'
            ]
        ];
    }
    public function messages(){
        return [
            'almacen_id.required'=>'Seleccione un almacen.',
            'categoria_id.required'=>'Seleccione una categoria.',
            'marca_id.required'=>'Seleccione una marca.',
            'nombre.required'=>'Ingrese nombre del producto.',
            'nombre.unique'=>'Ya existe un producto con este nombre.',
            'codigo_barra.unique'=>'Ya existe un producto con este codigo de barra.',
            'codigo_barra.required'=>'Ingrese codigo de barra del producto.',
            'precio_venta.required'=>'ingrese precio de venta',
            'precio_venta.numeric' => 'solo acepta números.',
            'precio_compra.required'=>'ingrese precio de compra',
            'precio_compra.numeric' => 'solo se permite números.',
            'stock.required'=>'ingrese stock',
            'stock.numeric' => 'solo se permite números.',
            'stock_minimo.required'=>'ingrese stock minimo',
            'stock_minimo.numeric' => 'solo se permite números.',
            'codigo_barra.numeric' => 'solo se permite números.',
            'unidad_medida.required'=>'Selecciona una unidad',
            'precio_compra.max' => 'su monto debe ser menor que el precio venta.',
        ];
    }
}