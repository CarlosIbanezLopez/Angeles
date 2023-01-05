<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Inventario;
use App\Models\Notasalida;
use Illuminate\Http\Request;
use PDF;

class NotasalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notasalidas = Notasalida::orderByDesc('id')->paginate(5);
        return view('notasalidas.index', compact('notasalidas'));
    }

    public function pdf()
    {
        $notasalidas = Notasalida::orderByDesc('id')->paginate();

        $pdf = PDF::loadView('notasalidas.pdf', ['notasalidas' => $notasalidas]);
        return $pdf->stream();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventarios = Inventario::get();
        return view('notasalidas.create', compact('inventarios'));
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
            'nro' => 'required|unique:notasalidas,nro',
            'motivo' => 'required|max:20',
            'inventario_id.*' => 'string',
            'inventario_id' => 'required|array',
        ]);

        $inventario = new Inventario;
        $notasalida = Notasalida::create($dataValidated);
        $notasalida->inventarios()->attach($request->input('inventario_id',[]));
        $inventario->whereIn('id', $request->input('inventario_id',[]))->update(['estado' => 'ELIMINADO']);

        Bitacora::create([
            'tabla' => 'notasalidas',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/notasalidas')->with('message', 'Nota de salida agregado correctamente');
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
    public function edit(Notasalida $notasalida)
    {
        $inventarios = Inventario::get();
        return view('notasalidas.edit', compact('notasalida','inventarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notasalida $notasalida)
    {
        $dataValidated = $request->validate([
            'nro' => 'required|unique:notasalidas,nro,'.$notasalida->nro.',nro',
            'motivo' => 'required|max:20',
            'inventario_id.*' => 'string',
            'inventario_id' => 'required|array',

        ]);

        Bitacora::create([
            'tabla' => 'notasalidas',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);
        $notasalida->inventarios()->sync($request->input('inventario_id',[]));

        $notasalida->update($dataValidated);
        $inventario = new Inventario;
        $inventario->whereIn('id', $request->input('inventario_id',[]))->update(['estado' => 'ACTIVO']);
        return redirect('/notasalidas')->with('message', 'Nota de salida actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notasalida $notasalida)
    {
        Bitacora::create([
            'tabla' => 'notasalidas',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($notasalida)))
        ]);
        $notasalida->inventarios()->detach();

        $notasalida->delete();

        return redirect('/notasalidas')->with('message', 'Nota de salida eliminado correctamente');
    }
}
