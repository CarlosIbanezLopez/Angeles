<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\Proveedore;
use App\Models\Mueble;
use App\Models\Notacompra;
use PDF;


class NotacompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notacompras = Notacompra::orderByDesc('provedor_id')->paginate(5);
        //$notacompras = Notacompra::orderByDesc('id')->paginate(5);
        //$muebles = Mueble::get();
        //dd($muebles);
        return view('notacompras.index', compact('notacompras'));
    }
    public function pdf()
    {
        $notacompras = Notacompra::orderByDesc('provedor_id')->paginate();

        $pdf = PDF::loadView('notacompras.pdf', ['notacompras' => $notacompras]);
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provedores = Proveedore::get();
        $muebles = Mueble::get();
        //$muebles = Mueble::pluck('codigo','id');
        return view('notacompras.create', compact('provedores','muebles'));
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
            'nro' => 'required|max:10|unique:notacompras,nro',
            'fecha' => 'required|max:20',
            'detalle' => 'required|max:50',
            'provedor_id' =>'required|exists:proveedores,id',
            'mueble_id.*' => 'string',
            'mueble_id' => 'required|array',


        ]);

        $notacompra = Notacompra::create($dataValidated);
        //$request->input('id');
        $notacompra->muebles()->attach($request->input('mueble_id',[]));



        Bitacora::create([
            'tabla' => 'notacompras',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/notacompras')->with('message', 'Mueble agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Notacompra $notacompra)
    {
        $provedores = Proveedore::get();
        $muebles = Mueble::get();
        return view('notacompras.edit', compact('notacompra','provedores','muebles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notacompra $notacompra)
    {
        $dataValidated = $request->validate([
            'nro' => 'required|max:10|unique:notacompras,nro,'.$notacompra->nro.',nro',
            'fecha' => 'required|max:20',
            'detalle' => 'required|max:50',
            'provedor_id' =>'required|exists:proveedores,id',
            'mueble_id.*' => 'string',
            'mueble_id' => 'required|array',
        ]);

        Bitacora::create([
            'tabla' => 'notacompras',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        $notacompra->muebles()->sync($request->input('mueble_id',[]));

        $notacompra->update($dataValidated);
        return redirect('/notacompras')->with('message', 'Nota de compra actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notacompra $notacompra)
    {
        Bitacora::create([
            'tabla' => 'notacompras',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($notacompra)))
        ]);
        $notacompra->muebles()->detach();
        $notacompra->delete();

        return redirect('/notacompras')->with('message', 'Empleado eliminado correctamente');
    }
}
