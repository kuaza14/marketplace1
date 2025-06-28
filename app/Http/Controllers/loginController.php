<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;
use Illuminate\Validation\ValidationData;
use Illuminate\Support\Facades\Auth;

use Validator;
use Hash;

class loginController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|string|min:5|',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return redirect('login')
                ->with('type', 'success')
                ->with('message', 'Usuario registrado exitosamente.');

    }

    public function check(Request $request)
    {

        $credential = $request->only ('email', 'password');

        if (Auth()->attempt($credential)) {
            return redirect()->intended('home')
                    ->with('type', 'success')
                    ->with('message', 'Bienvenido ' . auth()->user()->nombre);
        
        }
        return redirect()->back()
                    ->with('type', 'danger')
                    ->with('message', 'Credenciales incorrectas.');
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login')
                ->with('type', 'success')
                ->with('message', 'Has cerrado sesión correctamente.');
    }

}
