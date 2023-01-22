<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DocumentoCompraDetalle extends Model
{
    use HasFactory;

    protected $table = 'documento_compra_detalles'; 

    protected $primaryKey = 'id';

    public $timestamps=false;

    protected $fillable = [

    'DocumentoCompraId',
    'ProductoId ',
    'Producto',
    'NumeroSerieParte',
        'Cantidad',
        'CostoUnitario',
        'Impuestos',
        'Total'

    ];

    protected $guarded=[];

}
