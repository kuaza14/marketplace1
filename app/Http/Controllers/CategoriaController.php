<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;
use Illuminate\Validation\ValidationData;

use Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Categoria::all();

        return view('categorias.index', compact('data'));
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
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255|unique:categorias',
            'slug' => 'required|unique:categorias,slug',
            'descripcion' => 'nullable|max:255',
            'imagen' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $categoria = new Categoria();
        
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->slug = $request->slug;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/categorias'), $filename);
            $categoria->imagen = $filename;
        } else {
            $categoria->imagen = null; // O un valor por defecto
        }

        $categoria->save();

        return redirect('categoria')
        ->with('success', 'Categoria creada correctamente')
        ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255|unique:categorias,nombre,' . $id,
            'slug' => 'required|unique:categorias,slug,' . $id,
            'descripcion' => 'nullable|max:255',
            'imagen' => 'nullable|image',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $categoria = Categoria::findOrFail($id);
        
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->slug = $request->slug;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/categorias'), $filename);
            $categoria->imagen = $filename;
        }

        $categoria->save();

        return redirect('categoria')
        ->with('success', 'Categoria actualizada correctamente')
        ->with('type', 'success');
    }
/**
     * Remove the specified resource from storage.
     */
     
    

    
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        
        // Eliminar la imagen si existe
        if ($categoria->imagen && file_exists(public_path('img/categorias/' . $categoria->imagen))) {
            unlink(public_path('img/categorias/' . $categoria->imagen));
        }
        
        $categoria->delete();
        
        return redirect('categoria')
        ->with('success', 'Categoria eliminada correctamente')
        ->with('type', 'success');

    }
    public function enabled()
    { 

    
    }
}
