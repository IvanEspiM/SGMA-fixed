<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Sujeto extends Model
{
    use HasFactory;

    /**
     * @edgarbasurto
     * Método para obtener una vista del listado de clientes activos
     */

    public function getListadoClientes()
    {
        return DB::table('sujetos')
            ->select('*')
            ->where(
                [
                ['Activo', '=', '1'],
                ['TipoSujeto', '=', '1'],
                ]
            )
            ->get();
    }


    /**
     * @Rafael1108
     * Método para obtener un vista del listado de proveedores activos. 
     */
    public function getListadoProveedores()
    {
        return DB::table('sujetos')
            ->select('*')
            ->where(
                [
                ['Activo', '=', '1'],
                ['TipoSujeto', '=', '2'],
                ]
            )
            ->get();
    }

    /**
     * @Rafael1108
     * Método para obtener un vista del listado de proveedores activos. 
     */
    public function getProveedorByDNI($DNI)
    {
        return DB::table('sujetos')
            ->select('*')
            ->where(
                [
                ['DNI', 'like',  $DNI],
                ['TipoSujeto', '=', '2'],
                ]
            )
            ->first();
    }

    /**
     * @edgarbasurto
     * Método de busqueda de clientes por el DNI
     */
    public function getClienteByDNI($DNI)
    {
        return DB::table('sujetos')
            ->select('*')
            ->where(
                [
                ['DNI', 'like',  $DNI],
                ['TipoSujeto', '=', '1'],
                ]
            )
            ->first();
    }
}
