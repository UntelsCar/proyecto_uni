<?php

namespace App\Http\Controllers\pers_administrativo;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\RegistroEstacionamiento;
use Illuminate\Http\Request;

class EstacionamientoController extends Controller
{   

    public function buscarEstudiante($codigo){
        $estudiante = Estudiante::where('codigo', $codigo)->first();

        return response()->json([ 
            'mensaje'=>'estoy en mi api buscar',
            'estudiante'=> $estudiante
        ]);
        
    }
    /**
     * Display a listing of the resource./estudiante/${this.buscar}
     */
    public function index()
    {   
        $registros = RegistroEstacionamiento::all();
        return response()->json([ 
            'mensaje'=>'estoy en mi api index',
            'registros' => $registros
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $fotoVehiculoPath = null;

        if($request->hasFile('foto')){
            $fotoVehiculoPath = $request->file('foto')->store('fotos_registroEstacionamiento','public');
        }
        $registro = RegistroEstacionamiento::create([
            'fecha_ingreso' => $request->fecha_ingreso,
            //'fecha_salida' => $request->fecha_ingreso,
            'placa_vehiculo' => $request->placa_vehiculo,
            'tipo_vehiculo' => $request->tipo_vehiculo,
            'descripcion_vehiculo' => $request->descripcion_vehiculo,
            'foto_vehiculo' => $fotoVehiculoPath,
            'estado' => false,
            'estudiante_id' => $request->estudiante_id,
        ]);

        return response()->json([ 
            'mensaje' => 'estoy en api store',
            'registro' => $registro
        ]);
    }

    public function show(string $id)
    {
        $registro = RegistroEstacionamiento::with(['estudiante:estudiante_id,nombres,apellidos,edad'])->find($id);

        return response()->json([ 
            'mensaje' => 'estoy en api show',
            'registro' => $registro
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
