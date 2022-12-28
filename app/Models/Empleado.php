<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $primaryKey = 'ci';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'ci',
        'cargo',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'telefono',
        'email',
        'direccion',
        'id_edif'
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'id_edif');        
    }
}
