<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    public function index()
    {
        $edificios = Edificio::orderByDesc('id')->paginate(5);
        return view('edificios.index', compact('edificios'));
    }

    public function create()
    {
        return view('edificios.create');
    }

    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'nombre' => 'required|max:50',
            'ciudad' => 'required|in:PA,BE,LP,OR,CB,SC,PO,CH,TA',
            'direccion' => 'required|max:100',
            'telefono' => 'required|numeric|digits_between:1,9',
        ]);
        
        Edificio::create($dataValidated);
        
        Bitacora::create([
            'tabla' => 'edificios',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => 'id='.Edificio::max('id')
        ]);

        return redirect('/edificios')->with('message', 'Edificio agregado correctamente');
    }

    public function edit(Edificio $edificio)
    {
        return view('edificios.edit', compact('edificio'));
    }

    public function update(Request $request, Edificio $edificio)
    {
        $dataValidated = $request->validate([
            'nombre' => 'required|max:50',
            'ciudad' => 'required|in:PA,BE,LP,OR,CB,SC,PO,CH,TA',
            'direccion' => 'required|max:100',
            'telefono' => 'required|numeric|digits_between:1,9',
        ]);
        
        Bitacora::create([
            'tabla' => 'edificios',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($edificio)))
        ]); 

        $edificio->update($dataValidated);
        return redirect('/edificios')->with('message', 'Edificio actualizado correctamente');
    }

    public function destroy(Edificio $edificio)
    {
        Bitacora::create([
            'tabla' => 'edificios',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($edificio)))
        ]);

        $edificio->delete();
        
        return redirect('/edificios')->with('message', 'Edificio eliminado correctamente');
    }

    
}
