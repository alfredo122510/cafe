<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\usuarios;



class AuthController extends Controller
{
    public function verFormularioLogin()
    {
        return view('login');
    }

    public function crear_usuario(){
        $empleados = new usuarios;
        $empleados->nombre='juan';
        $empleados->contrasena='juan';
        $empleados->save();
        return "se creo correctamente";
    }

    public function login(Request $request)
    {
        // Obtenemos las credenciales del formulario
        $credenciales = $request->only('nombre', 'contrasena');

        // Buscamos si existe un empleado con las credenciales proporcionadas
        $usuarios = usuarios::where('nombre', $credenciales['nombre'])
                              ->where('contrasena', $credenciales['contrasena'])
                              ->first();

        // Si encontramos un empleado con esas credenciales, iniciamos sesión
        if ($usuarios) {

            session(['usuario_id' => $usuarios->id]);
            return redirect()->route('dashboard');
        }else{
            
        return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }

    


    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

}
