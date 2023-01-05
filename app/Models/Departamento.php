<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    public $inventario_codigo;
    protected $table = 'departamentos';

    public $timestamps = false;

    protected $fillable = [
        'nro',
        'precio',
        'sanitario',
        'cocina',
        'piso',
        'detalle',
        'edificio_id',
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'edificio_id');
    }

    public function getEdificio()
    {

        return $this->hasMany(Edificio::class, 'id', 'edificio_id');
    }
    public function inventarios()
    {
        return $this->belongsToMany(Inventario::class);
    }
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'departamento_id');
    }
}
