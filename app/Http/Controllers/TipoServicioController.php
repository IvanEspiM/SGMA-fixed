<?php

namespace App\Http\Controllers;

use App\Models\TipoServicio;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
{
    protected $TipoServicioModel;
    public function __construct(TipoServicio $tipoServicio)
    {
        $this->TipoServicioModel = $tipoServicio;
    }

    /**
     * Muestra la vista de todas las categorias.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parametros.tipoServicio.index')->with('tiposServicio', $this->TipoServicioModel->getListadoActivos());
    }

    /**
     * Mostrar el formulario para crear una nueva categoria.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros.tipoServicio.create');
    }

    /**
     * Almacena la categoría recién creada en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicio_new = new TipoServicio();

        $servicio_new->Nombre = $request->get('txtNombre');
        $servicio_new->Descripcion = $request->get('txtDescripcion');
        $servicio_new->UserCreated = "0";
        $servicio_new->save();
        return redirect('/servicios');
    }

    /**
     * Devuelve una categoría.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Muestra el formulario para editar una categoria.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ObjServicio = $this->TipoServicioModel::find($id);
        return view('parametros.tipoServicio.edit')->with('ObjServicio', $ObjServicio);
    }

    /**
     * Actualiza en Base datos el registro de la tabla categoría.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $servicio_edit = $this->TipoServicioModel::find($id);
        $servicio_edit->Nombre = $request->get('txtNombre');
        $servicio_edit->Descripcion = $request->get('txtDescripcion');
        $servicio_edit->save();

        return redirect('/servicios');
        if ($servicio_edit->save() == 1) {
            return redirect('/servicios')->with('actualizar', 'ok');
        } else {
            return redirect('/servicios')->with('actualizar', 'failed');
        }

    }

    /**
     * Elimina en Base de datos el registro de la tabla categoría.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Tener presente que el método sólo cambia de estado ya que no se permite eliminar registros
    }
}
