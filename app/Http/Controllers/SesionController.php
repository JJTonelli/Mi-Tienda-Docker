<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Categoria;

class SesionController extends Controller
{
    //

    public function crear()
    {
        return view('login',[
            'categorias' => Categoria::all()
        ]);
    }

    public function logout()
    {
        \Auth::logout();
        \Session::flush();
        return redirect('mi-tienda')->with('correcto', 'Cerraste tu sesion.');
    }

    public function login()
    {
        $atributos = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        

        if (! auth()->attempt($atributos)) {
            throw ValidationException::withMessages([
                'correo' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();
        
        return redirect('mi-tienda')->with('correcto', 'Ingresaste Correctamente.');
        
    }
}
