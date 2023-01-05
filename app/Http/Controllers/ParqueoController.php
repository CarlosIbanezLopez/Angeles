<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Edificio;
use App\Models\Departamento;
use App\Models\Parqueo;
use Illuminate\Http\Request;

class ParqueoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parqueos = Parqueo::paginate(5);
        return view('parqueos.index', compact('parqueos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edificios = Edificio::get();
        $departamentos = Departamento::get();
        return view('parqueos.create', compact('edificios','departamentos'));
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
            'nro' => 'required|unique:parqueos,nro',
            'piso' => 'required|numeric',
            'detalle' => 'required|max:50',
            'departamento_id' => 'required|exists:departamentos,id',
            'edificio_id' => 'required|exists:edificios,id',
        ]);

        Parqueo::create($dataValidated);

        Bitacora::create([
            'tabla' => 'parqueos',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/parqueos')->with('message', 'Parqueo agregado correctamente');
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
    public function edit(Parqueo $parqueo)
    {
        $edificios = Edificio::get();
        $departamentos = Departamento::get();
        return view('parqueos.edit', compact('parqueo','edificios','departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parqueo $parqueo)
    {
        $dataValidated = $request->validate([
            'nro' => 'required|unique:parqueos,nro,'.$parqueo->nro.',nro',
            'piso' => 'required|numeric',
            'detalle' => 'required|max:50',
            'departamento_id' => 'required|exists:departamentos,id',
            'edificio_id' => 'required|exists:edificios,id',

        ]);

        Bitacora::create([
            'tabla' => 'parqueos',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        $parqueo->update($dataValidated);
        return redirect('/parqueos')->with('message', 'Parqueo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parqueo $parqueo)
    {
        Bitacora::create([
            'tabla' => 'parqueos',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($parqueo)))
        ]);

        $parqueo->delete();

        return redirect('/parqueos')->with('message', 'Parqueo eliminado correctamente');
    }
}
