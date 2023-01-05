<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $table = 'contratos';
    public $timestamps = false;

    protected $fillable = [
        'nro',
        'residente_id',
        'avalador_ci',
        'fecha_inicio',
        'fecha_final',
        'meses',
        'precio',
        'descuento',
        'garantia',
        'departamento_id',
        'detalle',
        'estado',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }
    public function residente()
    {
        return $this->belongsTo(Residente::class, 'residente_id');
    }
    public function avalador()
    {
        return $this->belongsTo(Avalador::class, 'avalador_ci');
    }

}
