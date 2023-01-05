<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notaservicio extends Model
{
    use HasFactory;
    protected $table = 'notaservicios';

    public $timestamps = false;

    protected $fillable = [
        'nro',
        'motivo',
        'descripcion',
        'fecha',
        'total',
        'trabajador_ci',
        'empresa_id',
        'edificio_id',
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador_de_rm::class, 'trabajador_ci');
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa_de_rm::class, 'empresa_id');
    }
    public function edficio()
    {
        return $this->belongsTo(Edificio::class, 'edificio_id');
    }


}
