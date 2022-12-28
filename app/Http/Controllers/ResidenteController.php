<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Residente;
use Illuminate\Http\Request;

class ResidenteController extends Controller
{
    public function index()
    {
        $residentes = Residente::orderByDesc('id')->paginate(5);
        return view('residentes.index', compact('residentes'));
    }

    public function create()
    {
        return view('residentes.create');
    }

    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'ci' => 'nullable|numeric|unique:residentes,ci|digits_between:1,9',
            'nombres' => 'required|max:50',
            'apellido_paterno' => 'required|max:50',
            'apellido_materno' => 'nullable|max:50',
            'edad' => 'required|numeric|max:150',
            'sexo' => 'required|in:M,F',
            'nacionalidad' => 'required|max:50',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|unique:residentes,email|max:255',
        ]);
        
        Residente::create($dataValidated);
        
        Bitacora::create([
            'tabla' => 'residentes',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => 'id='.Residente::max('id')
        ]);

        return redirect('/residentes')->with('message', 'Residente agregado correctamente');
    }

    public function edit(Residente $residente)
    {
        return view('residentes.edit', compact('residente'));
    }

    public function update(Request $request, Residente $residente)
    {
        $dataValidated = $request->validate([
            'ci' => 'nullable|numeric|unique:residentes,ci,'.$residente->ci.',ci',
            'nombres' => 'required|max:50',
            'apellido_paterno' => 'required|max:50',
            'apellido_materno' => 'nullable|max:50',
            'edad' => 'required|numeric|max:150',
            'sexo' => 'required|in:M,F',
            'nacionalidad' => 'required|max:50',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|max:255|unique:residentes,email,'.$residente->ci.',ci',
        ]);
        
        Bitacora::create([
            'tabla' => 'residentes',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($residente)))
        ]); 

        $residente->update($dataValidated);
        return redirect('/residentes')->with('message', 'Residente actualizado correctamente');
    }

    public function destroy(Residente $residente)
    {
        Bitacora::create([
            'tabla' => 'residentes',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($residente)))
        ]);

        $residente->delete();
        
        return redirect('/residentes')->with('message', 'Residente eliminado correctamente');
    }
}
