<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador_de_rm extends Model
{
    use HasFactory;

    protected $table = 'trabajadores_de_rm';

    protected $primaryKey = 'ci';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'ci',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'direccion',
        'telefono',
        'email',
    ];
}
