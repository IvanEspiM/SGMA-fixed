<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehiculo extends Model
{
    use HasFactory;

    /**
     * @edgarbasurto
     * Método que consulta los vehiculos con estado Activo en la base de datos
     * y devuelve los resultados encontrados
     */

    public function getListadoVehiculos()
    {
        return DB::table('vehiculos')
            ->join('sujetos', 'vehiculos.SujetoId', '=', 'sujetos.id')
            ->select('vehiculos.*', 'sujetos.Nombre as Nombre', 'sujetos.Apellido as Apellido')
            ->where('vehiculos.Activo', '=', 1)
            ->get();
    }

    /**
     * @edgarbasurto
     * Método de busqueda de vehiculos por placa
     */
    public function getVehiculoByPlaca($placa)
    {
        return DB::table('vehiculos')
            ->join('sujetos', 'vehiculos.SujetoId', '=', 'sujetos.id')
            ->select('vehiculos.*', 'sujetos.DNI as DNI', 'sujetos.Nombre as Nombre', 'sujetos.Apellido as Apellido', 'sujetos.Email as Email')
            ->where([
                ['vehiculos.Activo', '=', 1],
                ['Placa', 'like',  $placa],
                ['vehiculos.Activo', '=', 1],
            ])
            ->first();
    }
}
