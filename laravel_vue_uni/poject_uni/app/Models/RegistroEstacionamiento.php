<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEstacionamiento extends Model
{
    use HasFactory;
    protected $primaryKey = 'rgEst_id';
    protected $fillable = 
    [
        'fecha_ingreso',
        'fecha_salida',
        'placa_vehiculo',
        'tipo_vehiculo',
        'descripcion_vehiculo',
        'foto_vehiculo',
        'estado',
        'estudiante_id'
    ];

    //funcion de relacion
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id', 'estudiante_id');
    }

}
