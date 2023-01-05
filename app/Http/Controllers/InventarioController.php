<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Mueble;
use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventarios = Inventario::paginate(5);
        //dd($inventarios);
        return view('inventarios.index', compact('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $muebles = Mueble::get();
        return view('inventarios.create', compact('muebles'));
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
            'codigo' => 'required|unique:inventarios,codigo',
            'estado' => 'required|max:50',
            'color' => 'required|max:50',
            'id_mueble' => 'required|exists:muebles,id',
        ]);

        Inventario::create($dataValidated);

        Bitacora::create([
            'tabla' => 'inventarios',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/inventarios')->with('message', 'Mueble agregado correctamente al inventario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventario $inventario)
    {
        $muebles = Mueble::get();
        return view('inventarios.edit', compact('inventario','muebles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        $dataValidated = $request->validate([
            'codigo' => 'required|max:26|unique:inventarios,codigo,'.$inventario->codigo.',codigo',
            'estado' => 'required|max:50',
            'color' => 'required|max:50',
            'id_mueble' => 'required|numeric',
        ]);

        Bitacora::create([
            'tabla' => 'inventarios',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        $inventario->update($dataValidated);
        return redirect('/inventarios')->with('message', 'Mueble actualizado correctamente al inventario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        Bitacora::create([
            'tabla' => 'inventarios',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($inventario)))
        ]);

        $inventario->delete();

        return redirect('/inventarios')->with('message', 'Mueble eliminado correctamente del inventario');
    }
}
