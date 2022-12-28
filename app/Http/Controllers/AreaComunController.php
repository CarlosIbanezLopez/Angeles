<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\Edificio;
use App\Models\AreaComun;

class AreaComunController extends Controller
{
    public function index()
    {
        $areas_comunes = AreaComun::paginate(5);
        //dd($areas_comunes);
        return view('areas_comunes.index', compact('areas_comunes'));
    }

    public function create()
    {
        $edificios = Edificio::get();
        return view('areas_comunes.create', compact('edificios'));
    }

    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'id_edif' => 'required|exists:edificios,id',
            'id' => 'required|unique:areas_comunes,id',
            //'id' => 'required|notexists:areas_comunes,id',
            //'id_edif' => 'required|id_edif|unique:edificios,id',
            //'id' => 'required|unique:areas_comunes,id',
            //'id_edif' => 'required|exists:edificios,id',
            //'id' => 'required|integer|areas_comunes,id',
            'nombre' => 'required|max:50',
            'precio_hora' => 'required|numeric',
            'descripcion' => 'nullable|max:50',
        ]);

        
        
        AreaComun::create($dataValidated);
        
        Bitacora::create([
            'tabla' => 'areas_comunes',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => 'id_edif='.$request->id_edif.'id='.$request->id
        ]);

        return redirect('/areas-comunes')->with('message', 'Area comun agregada correctamente');
    }

    public function edit(AreaComun $area_comun)
    {
        return view('areas_comunes', compact('area_comun'));
    }

    public function update(Request $request, AreaComun $area_comun)
    {
        $dataValidated = $request->validate([
            'id_edif' => 'required|exists:edificios,id',
            'id' => ['required','numeric','unique:areas_comunes,id_edif,NULL,id_edif,id,NULL,id'],
            'nombre' => 'required|max:50',
            'precio_hora' => 'required|numeric',
            'descripcion' => 'nullable|max:50',
        ]);
        
        Bitacora::create([
            'tabla' => 'areas_comunes',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($area_comun)))
        ]); 

        $area_comun->update($dataValidated);
        return redirect('/areas-comunes')->with('message', 'Area comun actualizada correctamente');
    }

    public function destroy(AreaComun $area_comun)
    {
        Bitacora::create([
            'tabla' => 'areas_comunes',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($area_comun)))
        ]);

        $area_comun->delete();
        
        return redirect('/areas-comunes')->with('message', 'Area comun eliminada correctamente');
    }
}
