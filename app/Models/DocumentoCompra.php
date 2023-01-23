<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DocumentoCompra extends Model
{
    use HasFactory;

    protected $table = 'documento_compras';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [

    'NumeroCompra',
    'FechaDocumento',
    'NumeroDocumento',
    'TipoDocumento',
        'SujetoId',
        'DNI',
        'Proveedor',
        'ValorSinImpuestos',
        'ValorImpuestos',
        'ValorTotal',
        'EstadoCompra'

    ];

    protected $guarded = [];
}
