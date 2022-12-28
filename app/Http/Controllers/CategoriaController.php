<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::orderByDesc('id')->paginate(5);
        return view('categorias.index', compact('categorias'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'nombre' => 'required|max:50',
            'descripcion' => 'nullable|max:50',
        ]);
        
        Categoria::create($dataValidated);
        
        Bitacora::create([  
            'tabla' => 'categorias',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => 'id='.Categoria::max('id')
        ]);

        return redirect('/categorias')->with('message', 'Categoria agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $dataValidated = $request->validate([
            'nombre' => 'required|max:50',
            'descripcion' => 'nullable|max:50',
        ]);
        
        Bitacora::create([
            'tabla' => 'categorias',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($categoria)))
        ]); 

        $categoria->update($dataValidated);
        return redirect('/categorias')->with('message', 'Categoria actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        Bitacora::create([
            'tabla' => 'categorias',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($categoria)))
        ]);

        $categoria->delete();
        
        return redirect('/categorias')->with('message', 'Categoria eliminado correctamente');
    }
}
