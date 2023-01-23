<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoServicio extends Model
{
    use HasFactory;

    /**
     * @Rafael1108
     * Método para obtener el listado de los tipos de servicios.
     */
    public function getListadoActivos()
    {
        return DB::table('tipo_servicios')
            ->where('tipo_servicios.Activo', '=', 1)
            ->get();
    }
}
