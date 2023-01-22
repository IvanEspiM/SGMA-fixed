<?php

namespace App\Http\Controllers;

use App\Models\OrdenesAtencion;
use App\Models\TipoServicio;
use App\Models\Usuario;
use Illuminate\Http\Request;

class OrdenesAtencionController extends Controller
{
    protected $OrdenAtencionModel;

    public function __construct(OrdenesAtencion $ordenAtencion)
    {
        $this->OrdenAtencionModel = $ordenAtencion;
    }
    /**
     * @edgarbasurto
     * Método que lista las ordenes de atencion
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('taller.ordenAtencion.index')
            ->with('ordenes', $this->OrdenAtencionModel->getListadoOrdenes());
    }

    /**
     * @edgarbasurto
     * Método que muestra el formulario de creacion de nuevas ordenes de atencion
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $numOrden = $this->OrdenAtencionModel->generarNumeroOrden();
        $mecanicos = new Usuario();
        $tipoServicios = new TipoServicio();
        return view('taller.ordenAtencion.create')
            ->with('mecanicos', $mecanicos->getListadoPorRol(3))
            ->with('numOrden', $numOrden)
            ->with('tipoServicios', $tipoServicios->getListadoActivos());
    }

    /**
     * @edgarbasurto
     * Método que recibe los datos ingresados y los guarda en la base de datos
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oda = new OrdenesAtencion();
        $oda->NumeroTransaccion = $request->get('numeroOrden');
        $oda->TipoServicioId = $request->get('tipoServicioId');
        $oda->MecanicoId = $request->get('mecanicoId');
        $oda->VendedorId = '1'; // se debe obtener de la session al ingresar con usuario VENDEDOR
        $oda->SujetoId = $request->get('clienteId');
        $oda->DNI = $request->get('dni');
        $oda->Cliente = $request->get('cliente');
        $oda->FechaHora = $request->get('fechaIngreso');
        $oda->VehiculoId = $request->get('vehiculoId');
        $oda->Placa = $request->get('placa');
        $oda->Vehiculo = $request->get('vehiculo');
        $oda->DescripcionRecepcionVehiculo = $request->get('observaciones');
        $oda->EstadoODA = $request->get('estadoODA');
        $oda->KilometroActualVehiculo = $request->get('kilometraje');
        $oda->UserCreated = '0';

        $oda->save();

        return redirect('/ordenAtencion')->with('guardar', 'ok');
    }
}
