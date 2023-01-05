<?php

namespace App\Http\Controllers;


use App\Models\Bitacora;
use App\Models\Residente;
use App\Models\Departamento;
use App\Models\Avalador;
use App\Models\Contrato;
use Illuminate\Http\Request;
use PDF;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = Contrato::paginate(5);
        return view('contratos.index', compact('contratos'));
    }
    public function pdf()
    {
        $contratos = Contrato::paginate();

        $pdf = PDF::loadView('contratos.pdf', ['contratos' => $contratos]);
        return $pdf->stream();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::get();
        $avaladores = Avalador::get();
        $residentes = Residente::get();
        return view('contratos.create', compact('avaladores','departamentos','residentes'));
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
            'nro' => 'required|unique:contratos,nro',
            'residente_id' => 'required|exists:residentes,id',
            'avalador_ci' => 'required|exists:avaladores,ci',
            'fecha_inicio' => 'required|max:10',
            'fecha_final' => 'required|max:10',
            'meses' => 'required|numeric',
            'precio' => 'required|numeric',
            'descuento' => 'required|numeric',
            'garantia' => 'required|numeric',
            'departamento_id' => 'required|exists:departamentos,id',
            'detalle' => 'required|max:50',
            'estado' => 'required|max:10',
        ]);

        Contrato::create($dataValidated);

        Bitacora::create([
            'tabla' => 'contratos',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/contratos')->with('message', 'Contrato agregado correctamente');
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
    public function edit(Contrato $contrato)
    {
        $departamentos = Departamento::get();
        $avaladores = Avalador::get();
        $residentes = Residente::get();
        return view('contratos.edit', compact('contrato','avaladores','departamentos','residentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contrato $contrato)
    {
        $dataValidated = $request->validate([
            'nro' => 'required|unique:contratos,nro,'.$contrato->nro.',nro',
            'residente_id' => 'required|exists:residentes,id',
            'avalador_ci' => 'required|exists:avaladores,ci',
            'fecha_inicio' => 'required|max:10',
            'fecha_final' => 'required|max:10',
            'meses' => 'required|numeric',
            'precio' => 'required|numeric',
            'descuento' => 'required|numeric',
            'garantia' => 'required|numeric',
            'departamento_id' => 'required|exists:departamentos,id',
            'detalle' => 'required|max:50',
            'estado' => 'required|max:10',

        ]);

        Bitacora::create([
            'tabla' => 'contratos',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        $contrato->update($dataValidated);
        return redirect('/contratos')->with('message', 'Contrato actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $contrato)
    {
        Bitacora::create([
            'tabla' => 'contratos',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($contrato)))
        ]);

        $parqueo->delete();

        return redirect('/contratos')->with('message', 'Contrato eliminado correctamente');
    }
}
