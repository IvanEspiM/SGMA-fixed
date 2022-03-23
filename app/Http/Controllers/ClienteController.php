<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sujeto;


class ClienteController extends Controller
{
    protected $ClienteModel;

    public function __construct(Sujeto $cliente)
    {
        $this->ClienteModel = $cliente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('taller.clientes.clientes')->with('clientes', $this->ClienteModel->getListadoClientes());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taller.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dni = $request->get('dni');
        $clientes = new Sujeto();

        $clientes->TipoSujeto = "1";
        $clientes->DNI = $dni;
        $clientes->Nombre = $request->get('nombre');
        $clientes->Apellido  = $request->get('apellido');
        $clientes->Direccion = $request->get('direccion');
        $clientes->Telefono = $request->get('telefono');
        $clientes->Email = $request->get('email');
        $clientes->Activo = "1";
        $clientes->UserCreated = "0";
        $clientes->save();

        return redirect('/clientes')->with('guardar', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = $this->ClienteModel::find($id);

        return view('taller.clientes.edit')->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = $this->ClienteModel::find($id);
        $cliente->TipoSujeto = 1;
        $cliente->Nombre = $request->get('nombre');
        $cliente->Apellido  = $request->get('apellido');
        $cliente->Direccion = $request->get('direccion');
        if (!is_null($request->get('telefono'))) {
            $cliente->Telefono =  $request->get('telefono');
        }
        $cliente->Email = $request->get('email');


        $cliente->Activo = 1;
        $cliente->UserUpdated = 0;
        $cliente->save();


        if ($cliente->save() == 1) {
            return redirect('/clientes')->with('actualizar', 'ok');
        }
        return redirect('/clientes')->with('actualizar', 'failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cliente = $this->ClienteModel::find($id);
        $cliente->Activo =  0;
        $cliente->save();

        return redirect('/clientes')->with('eliminar', 'ok');
    }

    public function getByDNI($DNI)
    {
        return $this->ClienteModel->getClienteByDNI($DNI);
    }
}
