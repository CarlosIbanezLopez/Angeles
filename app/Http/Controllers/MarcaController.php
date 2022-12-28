<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\Marca;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::orderByDesc('id')->paginate(5);
        return view('marcas.index', compact('marcas'));      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.create');
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
        ]);
        
        Marca::create($dataValidated);
        
        Bitacora::create([
            'tabla' => 'marcas',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => 'id='.Marca::max('id')
        ]);

        return redirect('/marcas')->with('message', 'Marca agregado correctamente');
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
    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $dataValidated = $request->validate([
            'nombre' => 'required|max:50',
        ]);
        
        Bitacora::create([
            'tabla' => 'marcas',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($marca)))
        ]); 

        $marca->update($dataValidated);
        return redirect('/marcas')->with('message', 'Marca actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        Bitacora::create([
            'tabla' => 'marcas',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($marca)))
        ]);

        $marca->delete();
        
        return redirect('/marcas')->with('message', 'Marca eliminado correctamente');
    }
}
