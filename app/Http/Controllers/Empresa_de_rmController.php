<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;
use App\Models\Empresa_de_rm;

class Empresa_de_rmController extends Controller
{

    public function index()
    {
        //$empresas_de_rm = Empresa_de_rm::latest()->paginate(5); //necesita created_at en la tabla
        $empresas_de_rm = Empresa_de_rm::orderByDesc('id')->paginate(5);
        return view('empresas_de_rm.index', compact('empresas_de_rm'));
    }

    public function create()
    {
        return view('empresas_de_rm.create');
    }

    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'nombre' => 'required|max:50',
            'ciudad' => 'required|in:PA,BE,LP,OR,CB,SC,PO,CH,TA',
            'direccion' => 'required|max:100',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|max:255|unique:empresas_de_rm,email'
        ]);

        Empresa_de_rm::create($dataValidated);

        Bitacora::create([
            'tabla' => 'empresas_de_rm',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/empresas-de-rm')->with('message', 'Empresa de reparación o mantenimiento agregada correctamente');
    }

    public function edit(Empresa_de_rm $empresa_de_rm)
    {
        return view('empresas_de_rm.edit', compact('empresa_de_rm'));
    }

    public function update(Request $request, Empresa_de_rm $empresa_de_rm)
    {
        $dataValidated = $request->validate([
            'nombre' => 'required|max:50',
            'ciudad' => 'required|in:PA,BE,LP,OR,CB,SC,PO,CH,TA',
            'direccion' => 'required|max:100',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|max:255|unique:empresas_de_rm,email,'.$empresa_de_rm->id.',id'
        ]);

        Bitacora::create([
            'tabla' => 'empresas_de_rm',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        $empresa_de_rm->update($dataValidated);
        //Empresa_de_rm::where('id', $empresa_de_rm->id)->update($dataValidated);
        return redirect('/empresas-de-rm')->with('message', 'Empresa de reparación o mantenimiento actualizada correctamente');
    }

    public function destroy(Empresa_de_rm $empresa_de_rm)
    {
        Bitacora::create([
            'tabla' => 'empresas_de_rm',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($empresa_de_rm)))
        ]);

        $empresa_de_rm->delete();

        return redirect('/empresas-de-rm')->with('message', 'Empresa de reparación o mantenimiento eliminada correctamente');
    }
}
