<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Trabajador_de_rm;
use Illuminate\Http\Request;

class Trabajador_de_rmController extends Controller
{
    public function index()
    {
        $trabajadores_de_rm = Trabajador_de_rm::paginate(5);
        return view('trabajadores_de_rm.index', compact('trabajadores_de_rm'));
    }

    public function create()
    {
        return view('trabajadores_de_rm.create');
    }

    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'ci' => 'required|numeric|unique:trabajadores_de_rm,ci|digits_between:1,9',
            'nombres' => 'required|max:50',
            'apellido_paterno' => 'required|max:50',
            'apellido_materno' => 'nullable|max:50',
            'sexo' => 'required|in:M,F',
            'direccion' => 'required|max:100',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|unique:trabajadores_de_rm,email|max:255'
        ]);
        
        Trabajador_de_rm::create($dataValidated);
        
        Bitacora::create([
            'tabla' => 'trabajadores_de_rm',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => 'ci='.$request->ci
        ]);

        return redirect('/trabajadores-de-rm')->with('message', 'Trabajador de reparación o mantenimiento agregado correctamente');
    }

    public function edit(Trabajador_de_rm $trabajador_de_rm)
    {
        return view('trabajadores_de_rm.edit', compact('trabajador_de_rm'));
    }

    public function update(Request $request, Trabajador_de_rm $trabajador_de_rm)
    {
        $dataValidated = $request->validate([
            'ci' => 'required|numeric|unique:trabajadores_de_rm,ci,'.$trabajador_de_rm->ci.',ci',
            'nombres' => 'required|max:50',
            'apellido_paterno' => 'required|max:50',
            'apellido_materno' => 'nullable|max:50',
            'sexo' => 'required|in:M,F',
            'direccion' => 'required|max:100',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|max:255|unique:trabajadores_de_rm,email,'.$trabajador_de_rm->ci.',ci',
        ]);
        
        Bitacora::create([
            'tabla' => 'trabajadores_de_rm',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($trabajador_de_rm)))
        ]); 

        $trabajador_de_rm->update($dataValidated);
        return redirect('/trabajadores-de-rm')->with('message', 'Trabajador de reparación o mantenimiento actualizado correctamente');
    }

    public function destroy(Trabajador_de_rm $trabajador_de_rm)
    {
        Bitacora::create([
            'tabla' => 'trabajadores_de_rm',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($trabajador_de_rm)))
        ]);

        $trabajador_de_rm->delete();
        
        return redirect('/trabajadores-de-rm')->with('message', 'Trabajador de reparación o mantenimiento eliminado correctamente');
    }
}
