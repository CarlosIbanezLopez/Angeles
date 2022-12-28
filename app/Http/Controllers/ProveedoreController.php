<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Proveedore;
use Illuminate\Http\Request;

class ProveedoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedore::orderByDesc('id')->paginate(5);
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create');
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
            'nombre' => 'required|max:50',
            'telefono' => 'required|numeric|digits_between:1,9',
            'ciudad' => 'required|in:PA,BE,LP,OR,CB,SC,PO,CH,TA',
            'direccion' => 'nullable|max:100',
            'email' => 'nullable|unique:proveedores,email|max:255',
        ]);
        
        Proveedore::create($dataValidated);
        
        Bitacora::create([
            'tabla' => 'proveedores',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => 'id='.Proveedore::max('id')
        ]);

        return redirect('/proveedores')->with('message', 'Proveedor agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedore $proveedore)
    {
        return view('proveedores.edit', compact('proveedore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedore $proveedore)
    {
        $dataValidated = $request->validate([
            'nombre' => 'required|max:50',
            'telefono' => 'required|numeric|digits_between:1,9',    
            'ciudad' => 'required|in:PA,BE,LP,OR,CB,SC,PO,CH,TA',
            'direccion' => 'nullable|max:100',
            'email' => 'nullable|max:255|unique:proveedores,email,'.$proveedore->id.',id'
        ]);
        
        Bitacora::create([
            'tabla' => 'proveedores',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($proveedore)))
        ]); 

        $proveedore->update($dataValidated);
        return redirect('/proveedores')->with('message', 'Proveedor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedore $proveedore)
    {
        Bitacora::create([
            'tabla' => 'proveedores',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($proveedore)))
        ]);

        $proveedore->delete();
        
        return redirect('/proveedores')->with('message', 'Proveedor eliminado correctamente');
    }
}
