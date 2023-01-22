<?php

namespace App\Http\Controllers;

use App\Exceptions\Notificacion;
use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    protected $EmpresaModel;

    public function __construct(Empresa $Empresa)
    {
        $this->EmpresaModel = $Empresa;
    }

    /**
     * @Rafael1108
     * Muestra la vista de todas las Empresas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp  = $this->EmpresaModel::all(['id', 'RUC', 'RazonSocial', 'NombreComercial']);

        return view('parametros.empresa.index')->with('emp', $emp[0]);
    }

    /**
     * @Rafael1108
     * Mostrar el formulario para crear una nueva Empresa.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Almacena la categoría recién creada en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @Rafael1108
     * Devuelve la empresa por default.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp = $this->EmpresaModel::all(['id', 'RUC', 'RazonSocial', 'NombreComercial']);
        return  $emp;
    }

    /**
     * @Rafael1108
     * Muestra el formulario para editar una Empresa.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @Rafael1108
     * Actualiza en Base datos el registro de la tabla empresa .
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $Empresa_edit = $this->EmpresaModel::find($id);

        $Empresa_edit->RazonSocial = $request->get('txtNEmpresa');
        $Empresa_edit->NombreComercial = $request->get('txtNComercial');

        if (!is_null($request->get('txtDireccion'))) {
            $Empresa_edit->Direccion = $request->get('txtDireccion');
        }

        $emp  = $this->EmpresaModel::all(['id', 'RUC', 'RazonSocial', 'NombreComercial']);
        if ($Empresa_edit->save() == 1) {
            return redirect('/empresa')->with('emp', $emp[0])->with('actualizar', 'ok');
        } else {
            return redirect('/empresa')->with('emp', $emp[0])->with('actualizar', 'failed');
        }
    }

    /**
     * @Rafael1108
     * Elimina en Base de datos el registro de la tabla empresa.
     * Tener presente que el método sólo cambia de estado ya que no se permite eliminar registros
     * @param      int $id
     * @return     \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
