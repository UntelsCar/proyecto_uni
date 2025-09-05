<?php

namespace App\Http\Controllers\pers_administrativo;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    //Funcion para mostrar estudiantes
    public function index(Request $request)
    {
        $estudiantes = Estudiante::all();
        return response()->json($estudiantes);
    }

    //funcion para agregar estudiante
    public function store(Request $request)
    {   
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos_estudiantes', 'public');
        }

        //Crear el estudiante
        $estudiante = Estudiante::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'edad' => $request->edad,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'dni' => $request->dni,
            'email' => $request->email,
            'foto' => $fotoPath,
            'codigo' => uniqid(),
        ]);

        $codigo_estudiante= date('y') . (date('y') + 5) . "0" . sprintf('%04d', (($estudiante->estudiante_id)%1000));
        $estudiante->update(['codigo'=> $codigo_estudiante]);
        return response()->json($request->nombres);
    }

    //funcion mostrar estudiantes
    public function show(string $id)
    {
        $estudiante = Estudiante::find($id);
        return response()->json($estudiante);
    }

    //funcion editar estudiantes
    public function update(Request $request, string $id)
    {
        $estudiante = Estudiante::find($id);
        
        $estudiante = Estudiante::findOrFail($id);

        $fotoPath = $estudiante->foto;
        if($request->hasFile('foto')){
            if($fotoPath){
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('fotos_estudiantes', 'public');
        }

        $estudiante->update([
        'nombres' => $request->nombres,
        'apellidos' => $request->apellidos,
        'edad' => $request->edad,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'dni' => $request->dni,
        'email' => $request->email,
        'foto' => $fotoPath,
        'codigo' => $request->codigo,
        ]);
        //$nombres = $request->input('nombres');

        return response()->json($estudiante);
    }

    public function destroy(string $id)
    {
        $estudiante = Estudiante::find($id);
        if(!$estudiante){
            return response()->json(["mensaje" => "Estudiante no encontrado"]);
        }
        $estudiante ->delete();
        return response()->json(["mensaje" => "estudiante eliminado"]);
    }
}
