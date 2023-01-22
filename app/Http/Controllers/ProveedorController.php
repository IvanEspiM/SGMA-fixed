<?php

namespace App\Http\Controllers;

use App\Exceptions\Notificacion;
use Illuminate\Http\Request;
use App\Models\Sujeto;


class ProveedorController extends Controller
{
    protected $ProveedorModel;

    public function __construct(Sujeto $proveedor)
    {
        $this->ProveedorModel = $proveedor;
    }

    /**
     * Muestra la vista de todas las categorias.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('compras.proveedores.index')->with('proveedores', $this->ProveedorModel->getListadoProveedores());
    }

    /**
     * Mostrar el formulario para crear una nueva categoria.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compras.proveedores.create');
    }

    /**
     * Almacena la categoría recién creada en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sujeto_new = new Sujeto();

        $sujeto_new->TipoSujeto = 2;
        $sujeto_new->DNI = $request->get('txtDNI');
        $sujeto_new->Nombre = $request->get('txtNombre');
        $sujeto_new->Apellido = $request->get('txtApellido');
        $sujeto_new->Direccion = $request->get('txtDireccion');
        $sujeto_new->Telefono = is_null($request->get('txtTelefono')) ? '' : $request->get('txtTelefono');
        $sujeto_new->Email = $request->get('txtEmail');
        $sujeto_new->Activo = 1;
        $sujeto_new->UserCreated = 0;
        $sujeto_new->save();
        return redirect('/proveedores');
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
        $ObjSujeto = $this->ProveedorModel::find($id);

        return view('compras.proveedores.edit')->with('ObjSujeto', $ObjSujeto);
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
        $sujeto_edit = $this->ProveedorModel::find($id);
        $sujeto_edit->TipoSujeto = 2;
        $sujeto_edit->Nombre = $request->get('txtNombre');
        $sujeto_edit->Apellido = $request->get('txtApellido');
        $sujeto_edit->Direccion = $request->get('txtDireccion');
        if (!is_null($request->get('txtTelefono'))) {
            $sujeto_edit->Telefono =  $request->get('txtTelefono');
        }
        $sujeto_edit->Email = $request->get('txtEmail');
        $sujeto_edit->Activo = 1;
        $sujeto_edit->UserUpdated = 0;
        $sujeto_edit->save();

        return redirect('/proveedores');
        if ($sujeto_edit->save() == 1) {
            return redirect('/proveedores')->with('actualizar', 'ok');
        } else {
            return redirect('/proveedores')->with('actualizar', 'failed');
        }
    }

    /**
     * Elimina en Base de datos el registro de la tabla categoría.
     * Tener presente que el método sólo cambia de estado ya que no se permite eliminar registros
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor_del = $this->ProveedorModel::find($id);
        $proveedor_del->Activo =  0;
        $proveedor_del->save();

        return redirect('/proveedores');
    }

    /**
     * Muestra el formulario modal para eliminar una categoria.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function del($id)
    {
        $ObjProveedor = $this->ProveedorModel::find($id);
        return view('compras.proveedores.delete')->with('ObjProveedor', $ObjProveedor);
    }

    /**
     * Función que busca a un proveedor por el DNI.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getByDNI($DNI)
    {
        return $this->ProveedorModel->getProveedorByDNI($DNI);
    }
}
