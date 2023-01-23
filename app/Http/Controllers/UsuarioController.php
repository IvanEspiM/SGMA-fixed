<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    protected $UsuarioModel;
    public function __construct(Usuario $Usuario)
    {
        $this->UsuarioModel = $Usuario;
    }

    /**
     * Muestra la vista de todas las categorias.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parametros.usuario.index')->with('usuarios', $this->UsuarioModel->getListadoActivos());
    }

    /**
     * Mostrar el formulario para crear una nueva categoria.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros.usuario.create');
    }

    /**
     * Almacena la usuario
     *  recién creada en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate(
            [
            'TipoRol' => 'required',
            'NickName' => 'required',
            'Email' => 'required',
            'NombreCompleto' => 'required',
            'PasswordSALT' => 'required',
            'PasswordHASH' => 'required',

            ]
        );


        $data = new Usuario();
        $data->id = $request->id;
        $data->TipoRol = $request->TipoRol;
        $data->NickName = $request->NickName;
        $data->Email = $request->Email;
        $data->NombreCompleto = $request->NombreCompleto;
        $data->PasswordSALT = password_hash($request->PasswordSALT, PASSWORD_DEFAULT, array('cost' => 9));
        $data->PasswordHASH = password_hash($request->PasswordHASH, PASSWORD_DEFAULT, array('cost' => 9));

        $data->Activo = "1";
        $data->UsuarioCreacion = "1";
        $data->UserCreated = "1";

        $data->save();
        return redirect('/usuarios')->with('Los datos fueron agregados correctamente.');
    }

    /**
     * Devuelve un usuario.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Muestra el formulario para editar un usuario
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ObjUsuario = $this->UsuarioModel::find($id);
        $usuarios = new Usuario();

        return view('parametros.usuario.edit')->with('ObjUsuario', $ObjUsuario)->with('usuarios', $usuarios->getListadoActivos());
    }

    /**
     * Actualiza en Base datos el registro de la tabla usuario
     * .
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate(
            [
            'TipoRol' => 'required',
            'NickName' => 'required',
            'Email' => 'required',
            'NombreCompleto' => 'required',
            'PasswordSALT' => 'required',
            'PasswordHASH' => 'required',

            ]
        );



        $data = Usuario::find($id);
        $data->TipoRol = $request->TipoRol;
        $data->NickName = $request->NickName;
        $data->Email = $request->Email;
        $data->NombreCompleto = $request->NombreCompleto;

        $data->PasswordSALT = password_hash($request->PasswordSALT, PASSWORD_DEFAULT, array('cost' => 9));
        $data->PasswordHASH = password_hash($request->PasswordHASH, PASSWORD_DEFAULT, array('cost' => 9));


        $data->Activo = "1";
        $data->UsuarioCreacion = "1";
        $data->UserCreated = "0";

        $data->save();
        return redirect('/usuarios')->with('Datos actualizados correctamente.');
    }

    /**
     * Elimina en Base de datos el registro de la tabla usuario
     * .
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = $this->UsuarioModel::find($id);
        $data->Activo =  0;
        $data->save();


        return redirect('usuarios');
    }
}
