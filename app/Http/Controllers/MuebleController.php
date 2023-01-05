<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\Categoria;
use App\Models\Mueble;
use App\Models\Marca;

class MuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $muebles = Mueble::orderByDesc('id')->paginate(5);
        //dd($muebles);
        return view('muebles.index', compact('muebles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::get();
        $categorias = Categoria::get();
        return view('muebles.create', compact('marcas','categorias'));
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
            'codigo' => 'required|max:50|unique:muebles,codigo',
            'descripcion' => 'required|max:50',
            'precio' => 'required|numeric',
            'colores' => 'required|numeric|digits_between:1,9',
            'categoria_id' =>'required|exists:categorias,id',

        ]);

        $mueble = Mueble::create($dataValidated);
        //$request->input('id');
        $mueble->marcas()->attach($request->input('marca_id'));



        Bitacora::create([
            'tabla' => 'muebles',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/muebles')->with('message', 'Mueble agregado correctamente');
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
    public function edit(Mueble $mueble)
    {
        $marcas = Marca::get();
        $categorias = Categoria::get();
        return view('muebles.edit', compact('mueble','marcas','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mueble $mueble)
    {
        $dataValidated = $request->validate([
            'codigo' => 'required|max:50|unique:muebles,codigo,'.$mueble->codigo.',codigo',
            'descripcion' => 'required|max:50',
            'precio' => 'required|numeric',
            'colores' => 'required|numeric|digits_between:1,9',
            'categoria_id' =>'required|exists:categorias,id',
        ]);

        $mueble->update($dataValidated);
        $mueble->marcas()->sync($request->input('marca_id'));
        Bitacora::create([
            'tabla' => 'muebles',
            'accion' => 'U',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);
        return redirect('/muebles')->with('message', 'Mueble actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mueble $mueble)
    {
        Bitacora::create([
            'tabla' => 'muebles',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($mueble)))
        ]);
        $mueble->marcas()->detach();
        $mueble->delete();

        return redirect('/muebles')->with('message', 'Mueble eliminado correctamente');
    }
}
