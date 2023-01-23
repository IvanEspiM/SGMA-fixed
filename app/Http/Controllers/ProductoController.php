<?php

namespace App\Http\Controllers;

use App\Exceptions\Notificacion;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    protected $ProductoModel;
    public function __construct(Producto $producto)
    {
        $this->ProductoModel = $producto;
    }

    /**
     * Muestra la vista de todos los productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventario.productos.index')->with('productos', $this->ProductoModel->getListadoActivoConCategorias());
    }

    /**
     * Mostrar el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $Categoria = new Categoria();
        return view('inventario.productos.create')->with('categorias', $Categoria->getListadoActivos());
    }

    /**
     * Almacena el producto recién creada en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->get('CategoriaId') > 0) {
            $Descripcion = "";
            if (!is_null($request->get('Descripcion'))) {
                $Descripcion = $request->get('Descripcion');
            }

            $producto_edit = new Producto();
            $producto_edit->CategoriaId  = $request->get('CategoriaId');
            ;
            $producto_edit->Codigo = $request->get('Codigo');
            $producto_edit->Nombre = $request->get('Nombre');
            $producto_edit->Descripcion =  $Descripcion;
            $producto_edit->NumeroParte = $request->get('NumeroParte');
            $producto_edit->Precio = $request->get('Precio');
            $producto_edit->Costo = $request->get('Costo');
            $producto_edit->Activo = "1";
            $producto_edit->UserCreated = 0;
            $producto_edit->save();

            return redirect('/productos');
        } else {
            return "Error";
        }
    }

    /**
     * Devuelve un producto.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Muestra el formulario para editar un producto.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ObjProducto = $this->ProductoModel::find($id);
        $Categoria = new Categoria();

        return view('inventario.productos.edit')->with('ObjProducto', $ObjProducto)->with('categorias', $Categoria->getListadoActivos());
    }

    /**
     * Actualiza en Base datos el registro de la tabla producto.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $Descripcion = "";
        if (!is_null($request->get('Descripcion'))) {
            $Descripcion = $request->get('Descripcion');
        }
        $producto_edit = $this->ProductoModel::find($id);
        $producto_edit->CategoriaId  = $request->get('CategoriaId');
        ;
        $producto_edit->Codigo = $request->get('Codigo');
        $producto_edit->Nombre = $request->get('Nombre');
        $producto_edit->Descripcion =  $Descripcion;
        $producto_edit->NumeroParte = $request->get('NumeroParte');
        $producto_edit->Precio = $request->get('Precio');
        $producto_edit->Costo = $request->get('Costo');
        $producto_edit->Activo =  1;
        $producto_edit->UserUpdated = 0;
        if ($producto_edit->save() == 1) {
        }
        return redirect('/productos');
    }

    /**
     * Elimina en Base de datos el registro de la tabla producto.
     * Tener presente que el método sólo cambia de estado ya que no se permite eliminar registros
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producto_edit = $this->ProductoModel::find($id);
        $producto_edit->Activo =  0;
        $producto_edit->save();

        return redirect('/productos');
    }

    /**
     * Muestra el formulario modal para eliminar un producto.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function del($id)
    {
        $ObjProducto = $this->ProductoModel::find($id);
        return view('inventario.productos.delete')->with('ObjProducto', $ObjProducto);
    }
}
