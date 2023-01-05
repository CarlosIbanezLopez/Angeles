<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Contrato;
use App\Models\Residente;
use App\Models\Pago;
use Illuminate\Http\Request;
use PDF;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::orderByDesc('residente_id')->paginate(5);
        return view('pagos.index', compact('pagos'));
    }
    public function pdf()
    {
        $pagos = Pago::orderByDesc('residente_id')->paginate();

        $pdf = PDF::loadView('pagos.pdf', ['pagos' => $pagos]);
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contratos = Contrato::get();
        $residentes = Residente::get();
        return view('pagos.create', compact('contratos','residentes'));
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
            'numeropago' => 'required|numeric',
            'monto' => 'required|numeric',
            'fecha' => 'required|max:20',
            'residente_id' => 'required|exists:residentes,id',
            'contrato_id' => 'required|exists:contratos,id',
        ]);

        Pago::create($dataValidated);

        Bitacora::create([
            'tabla' => 'pagos',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);


        return redirect('/pagos')->with('message', 'Pago agregado correctamente');
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
    public function edit(Pago $pago)
    {
        $contratos = Contrato::get();
        $residentes = Residente::get();
        return view('pagos.edit', compact('pago','contratos','residentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        $dataValidated = $request->validate([
            'nro' => 'required|unique:pagos,nro,'.$pago->nro.',nro',
            'numeropago' => 'required|numeric',
            'monto' => 'required|numeric',
            'fecha' => 'required|max:20',
            'residente_id' => 'required|exists:residentes,id',
            'contrato_id' => 'required|exists:contratos,id',

        ]);

        Bitacora::create([
            'tabla' => 'pagos',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        $pago->update($dataValidated);
        return redirect('/pagos')->with('message', 'Pago actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        Bitacora::create([
            'tabla' => 'pagos',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($pago)))
        ]);

        $pago->delete();

        return redirect('/pagos')->with('message', 'Pago eliminado correctamente');
    }
}
