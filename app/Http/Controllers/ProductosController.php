<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Producto::all();

        return view('productos.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new producto();
        
        $producto->nombre = $request->nombre;
        $producto->slug = $request->slug;
        $producto->descripcion = $request->descripcion;
        $producto->valor = $request->valor;
        
        if ($request->hasFile('imagen')) {
            $request->validate([
                'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }
       
        $producto->estado_producto = $request->estado_producto;
        $producto->categoria_id = $request->categoria_id;
        $producto->usuario_id = $request->usuario_id;
        $producto->ciudad_id = $request->ciudad_id;

        
      
        

        $producto->save();

        return redirect('producto')->with('success', 'producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
