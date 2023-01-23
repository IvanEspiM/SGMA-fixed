<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    use HasFactory;

    /**
     * @Rafael1108
     * Método para obtener el listado de los productos activos.
     */
    public function getListadoActivos()
    {
        return DB::table('productos')
            ->where('productos.Activo', '=', 1)
            ->get();
    }
    /**
     * @Rafael1108
     * Método para obtener el listado de los productos activos.
     */
    public function getListadoActivoConCategorias()
    {
        return DB::table('productos')
            ->join('categorias', 'productos.CategoriaId', '=', 'categorias.Id')
            ->select('productos.*', 'categorias.Nombre as Categoria')
            ->where('productos.Activo', '=', 1)
            ->get();
    }
}
