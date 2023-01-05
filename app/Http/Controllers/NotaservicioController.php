<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Trabajador_de_rm;
use App\Models\Empresa_de_rm;
use App\Models\Notaservicio;
use App\Models\Edificio;
use Illuminate\Http\Request;

class NotaservicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notaservicios = Notaservicio::paginate(5);
        return view('notaservicios.index', compact('notaservicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trabajadores = Trabajador_de_rm::get();
        $empresas = Empresa_de_rm::get();
        $edificios = Edificio::get();
        return view('notaservicios.create', compact('trabajadores','empresas','edificios'));
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
            'nro' => 'required|max:20|unique:notaservicios,nro',
            'motivo' => 'required|max:50',
            'descripcion' => 'required|max:50',
            'fecha' => 'required|max:50',
            'total' => 'required|numeric',
            'trabajador_ci' => 'required|exists:trabajadores_de_rm,ci',
            'empresa_id' => 'required|exists:empresas_de_rm,id',
            'edificio_id' => 'required|exists:edificios,id',
        ]);

        Notaservicio::create($dataValidated);

        Bitacora::create([
            'tabla' => 'notaservicios',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);


        return redirect('/notaservicios')->with('message', 'Nota de servicio agregado correctamente');
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
    public function edit(Notaservicio $notaservicio)
    {
        $edificios = Edificio::get();
        $trabajadores = Trabajador_de_rm::get();
        $empresas = Empresa_de_rm::get();
        return view('notaservicios.edit', compact('notaservicio','trabajadores','empresas','edificios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notaservicio $notaservicio)
    {
        $dataValidated = $request->validate([
            'nro' => 'required|unique:notaservicios,nro,'.$notaservicio->nro.',nro',
            'motivo' => 'required|max:50',
            'descripcion' => 'required|max:50',
            'fecha' => 'required|max:50',
            'total' => 'required|numeric',
            'trabajador_ci' => 'required|exists:trabajadores_de_rm,ci',
            'empresa_id' => 'required|exists:empresas_de_rm,id',
            'edificio_id' => 'required|exists:edificios,id',

        ]);

        Bitacora::create([
            'tabla' => 'notaservicios',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        $notaservicio->update($dataValidated);
        return redirect('/notaservicios')->with('message', 'Nota de servicio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notaservicio $notaservicio)
    {
        Bitacora::create([
            'tabla' => 'notaservicios',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($notaservicio)))
        ]);

        $notaservicio->delete();

        return redirect('/notaservicios')->with('message', 'Nota de servicio eliminado correctamente');
    }
}
