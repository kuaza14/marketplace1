<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;
use Illuminate\Validation\ValidationData;

use Validator;
use Hash;

class loginController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|',
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
        $validator = $request->only ('email', 'password');

        if (auth()->attempt($credential)) {
            return redirect('home')
                    ->with('type', 'success')
                    ->with('message', 'Bienvenido ' . auth()->user()->nombre);
        } else {
            return redirect('login')
                    ->with('type', 'error')
                    ->with('message', 'Credenciales incorrectas.');
        }
    }

}
