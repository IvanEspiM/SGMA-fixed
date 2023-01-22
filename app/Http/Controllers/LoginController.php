<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\LogAcceso;
use Session;
class LoginController extends Controller
{
    function login()
    {
        return view('login');
    }
    function check_login(Request $request)
    {
        //metodo que revisa los valores ingresados en los campos de la tabla sql
        $request->validate(
            [
            'NickName' => 'required',
            'PasswordHASH' => 'required',
            ]
        );
       
        $consulta = Usuario::where('NickName', $request->NickName)->get(); //permite comprobar si existe el usuario
        $cuantos = count($consulta);//cuenta cuantos registros hay
        if($cuantos >0 and Hash::check($request->PasswordHASH, $consulta[0]->PasswordHASH)) {
            session_start();
            $usuarioData = Usuario::where(['NickName'=>$request->NickName])->get();
           
            session(['usuarioData'=>$usuarioData]);
            session(['usuarioDataRol'=>$usuarioData[0]->TipoRol]);
            session(['usuarionickname'=>$usuarioData[0]->NickName]);
            date_default_timezone_set('America/Bogota');
            // $DateAndTime = date('Y-m-d h:m:s', time());
            $DateAndTime = date("Y-m-d h:m:s");
            $ip_add = $_SERVER['REMOTE_ADDR'];
            $dataAccess = new LogAcceso;
            $dataAccess->UsuarioId =$usuarioData[0]->id;
            $dataAccess->FechaHoraAcceso =  $DateAndTime;
            $dataAccess->Nombre_Navegador ="Google Chrome";
            $dataAccess->IP = $ip_add;
            $dataAccess->InfoAdicional = "OK ";
            $dataAccess->save();
            // session(['UsuarioId'=>$dataAccess->id]);
    
            return redirect("/dashboard");
        }
        else{
            return redirect('/')->with('msg', 'usuario/contraseña no valido!');
        }


       
    }

    function logout()
    {
        session()->forget(['usuarioData']);
        return redirect('/');
    }
}
