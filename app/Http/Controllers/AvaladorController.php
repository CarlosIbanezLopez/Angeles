<?php

namespace App\Http\Controllers;

use App\Models\Avalador;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class AvaladorController extends Controller
{
    public function index()
    {
        $avaladores = Avalador::paginate(5);
        return view('avaladores.index', compact('avaladores'));
    }

    public function create()
    {
        return view('avaladores.create');
    }

    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'ci' => 'required|numeric|unique:avaladores,ci|digits_between:1,9',
            'nombres' => 'required|max:50',
            'apellido_paterno' => 'required|max:50',
            'apellido_materno' => 'nullable|max:50',
            'sexo' => 'required|in:M,F',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|unique:avaladores,email|max:255',
            'direccion' => 'required|max:100'
        ]);

        Avalador::create($dataValidated);

        Bitacora::create([
            'tabla' => 'avaladores',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/avaladores')->with('message', 'Avalador agregado correctamente');
    }

    public function edit(Avalador $avalador)
    {
        return view('avaladores.edit', compact('avalador'));
    }

    public function update(Request $request, Avalador $avalador)
    {
        $dataValidated = $request->validate([
            'ci' => 'required|numeric|unique:avaladores,ci,'.$avalador->ci.',ci',
            'nombres' => 'required|max:50',
            'apellido_paterno' => 'required|max:50',
            'apellido_materno' => 'nullable|max:50',
            'sexo' => 'required|in:M,F',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|max:255|unique:avaladores,email,'.$avalador->ci.',ci',
            'direccion' => 'required|max:100'
        ]);

        Bitacora::create([
            'tabla' => 'avaladores',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        $avalador->update($dataValidated);
        return redirect('/avaladores')->with('message', 'Avalador actualizado correctamente');
    }

    public function destroy(Avalador $avalador)
    {
        Bitacora::create([
            'tabla' => 'avaladores',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($avalador)))
        ]);

        $avalador->delete();

        return redirect('/avaladores')->with('message', 'Avalador eliminado correctamente');
    }
}
