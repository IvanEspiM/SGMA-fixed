<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
        'NumeroCompra'=> 'required',
		'FechaDocumento'=> 'required',
		'NumeroDocumento'=> 'required',
		'TipoDocumento'=> 'required',
    	'SujetoId'=> 'required',
    	'DNI'=> 'required',
        'Proveedor'=> 'required',
        'ValorSinImpuestos'=> 'required',
        'ValorImpuestos'=> 'required',
        'ValorTotal'=> 'required',
        'EstadoCompra'=> 'required',
        'DocumentoCompraId'=> 'required',
		'ProductoId '=> 'required',
		'Producto'=> 'required',
    	'Cantidad'=> 'required',
    	'CostoUnitario'=> 'required',
        'Impuestos'=> 'required'
        ];
    }
}
