<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Edificio;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::paginate(5);
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $edificios = Edificio::get();
        return view('empleados.create', compact('edificios'));
    }

    public function store(Request $request)
    {

        $dataValidated = $request->validate([
            'ci' => 'required|numeric|unique:empleados,ci|digits_between:1,9',
            'cargo' => 'required|max:50',
            'nombres' => 'required|max:50',
            'apellido_paterno' => 'required|max:50',
            'apellido_materno' => 'nullable|max:50',
            'sexo' => 'required|in:M,F',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|max:255|unique:empleados,email',
            'direccion' => 'required|max:100',
            'id_edif' => 'required|exists:edificios,id'
        ]);

        Empleado::create($dataValidated);

        Bitacora::create([
            'tabla' => 'empleados',
            'accion' => 'I',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        return redirect('/empleados')->with('message', 'Empleado agregado correctamente');
    }

    public function edit(Empleado $empleado)
    {
        $edificios = Edificio::get();
        return view('empleados.edit', compact('empleado','edificios'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $dataValidated = $request->validate([
            'ci' => 'required|numeric|unique:empleados,ci,'.$empleado->ci.',ci',
            'cargo' => 'required|max:50',
            'nombres' => 'required|max:50',
            'apellido_paterno' => 'required|max:50',
            'apellido_materno' => 'nullable|max:50',
            'sexo' => 'required|in:M,F',
            'telefono' => 'required|numeric|digits_between:1,9',
            'email' => 'nullable|max:255|unique:empleados,email,'.$empleado->ci.',ci',
            'direccion' => 'required|max:100',
            'id_edif' => 'required|exists:edificios,id'
        ]);

        Bitacora::create([
            'tabla' => 'empleados',
            'id_usuario' => auth()->user()->id,
            'accion' => 'U',
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($dataValidated)))
        ]);

        $empleado->update($dataValidated);
        return redirect('/empleados')->with('message', 'Empleado actualizado correctamente');
    }

    public function destroy(Empleado $empleado)
    {
        Bitacora::create([
            'tabla' => 'empleados',
            'accion' => 'D',
            'id_usuario' => auth()->user()->id,
            'datos' => str_replace(':','=',str_replace(['{','}','"'], '', json_encode($empleado)))
        ]);

        $empleado->delete();

        return redirect('/empleados')->with('message', 'Empleado eliminado correctamente');
    }
}
