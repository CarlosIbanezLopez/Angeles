<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Edificio;
use App\Models\Departamento;
use App\Models\Inventario;
use Illuminate\Http\Request;


class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::orderByDesc('id')->paginate(5);
        return view('departamentos.index', compact('departamentos'));
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
        return view('departamentos.create', compact('edificios','inventarios'));
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
            'nro' => 'required|unique:departamentos,nro',
            'precio' => 'required|numeric',
            'sanitario' => 'required|numeric',
            'cocina' => 'required|numeric',
            'piso' => 'required|numeric',
            'detalle' => 'required|max:50',
            'edificio_id' => 'required|exists:edificios,id',
            'inventario_id.*' => 'string',
            'inventario_id' => 'required|array',
        ]);

        $departamento = Departamento::create($dataValidated);
        $departamento->inventarios()->attach($request->input('inventario_id',[]));

        Bitacora::create([
            'tabla' => 'departamentos',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/departamentos')->with('message', 'Departamento agregado correctamente');
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
    public function edit(Departamento $departamento)
    {
        $edificios = Edificio::get();
        $inventarios = Inventario::get();
        return view('departamentos.edit', compact('departamento','edificios','inventarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $dataValidated = $request->validate([
            'nro' => 'required|unique:departamentos,nro,'.$departamento->nro.',nro',
            'precio' => 'required|numeric',
            'sanitario' => 'required|numeric',
            'cocina' => 'required|numeric',
            'piso' => 'required|numeric',
            'detalle' => 'required|max:50',
            'edificio_id' => 'required|exists:edificios,id',
            'inventario_id.*' => 'string',
            'inventario_id' => 'required|array',

        ]);

        Bitacora::create([
            'tabla' => 'departamentos',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);
        $departamento->inventarios()->sync($request->input('inventario_id',[]));



        $departamento->update($dataValidated);
        return redirect('/departamentos')->with('message', 'Departamento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        Bitacora::create([
            'tabla' => 'departamentos',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($departamento)))
        ]);
        $departamento->inventarios()->detach();

        $departamento->delete();

        return redirect('/departamentos')->with('message', 'Departamento eliminado correctamente');
    }
}
