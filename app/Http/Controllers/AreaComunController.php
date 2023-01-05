<?php

namespace App\Http\Controllers;
use App\Models\Bitacora;
use App\Models\Edificio;
use App\Models\Areacomun;
use App\Models\Inventario;

use Illuminate\Http\Request;

class AreacomunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areacomuns = Areacomun::orderByDesc('id')->paginate(5);
        return view('areacomuns.index', compact('areacomuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edificios = Edificio::get();
        $inventarios = Inventario::get();
        return view('areacomuns.create', compact('edificios','inventarios'));
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
            'nombre' => 'required|unique:areacomuns,nombre',
            'precio' => 'required|numeric',
            'descripcion' => 'required|max:50',
            'edificio_id' => 'required|exists:edificios,id',
            'inventario_id.*' => 'string',
            'inventario_id' => 'required|array',
        ]);

        $areacomun = Areacomun::create($dataValidated);
        $areacomun->inventarios()->attach($request->input('inventario_id',[]));

        Bitacora::create([
            'tabla' => 'areacomuns',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/areacomuns')->with('message', 'Area comun agregado correctamente');
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
    public function edit(Areacomun $areacomun)
    {
        $edificios = Edificio::get();
        $inventarios = Inventario::get();
        return view('areacomuns.edit', compact('areacomun','edificios','inventarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Areacomun $areacomun)
    {
        $dataValidated = $request->validate([
            'nombre' => 'required|unique:areacomuns,nombre,'.$areacomun->nombre.',nombre',
            'precio' => 'required|numeric',
            'descripcion' => 'required|max:50',
            'edificio_id' => 'required|exists:edificios,id',
            'inventario_id.*' => 'string',
            'inventario_id' => 'required|array',

        ]);

        Bitacora::create([
            'tabla' => 'areacomuns',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);
        $areacomun->inventarios()->sync($request->input('inventario_id',[]));

        $areacomun->update($dataValidated);
        return redirect('/areacomuns')->with('message', 'Area comun actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Areacomun $areacomun)
    {
        Bitacora::create([
            'tabla' => 'areacomuns',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($areacomun)))
        ]);
        $areacomun->inventarios()->detach();

        $areacomun->delete();

        return redirect('/areacomuns')->with('message', 'Area comun eliminado correctamente');
    }
}
