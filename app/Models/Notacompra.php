<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notacompra extends Model
{
    public $mueble_id;
    use HasFactory;
    protected $table = 'notacompras';

    public $timestamps = false;

    protected $fillable = [
        'nro',
        'fecha',
        'precio',
        'provedor_id',
        'detalle',
    ];

    public function proveedore()
    {
        return $this->belongsTo(Proveedore::class, 'provedor_id');
    }
    public function muebles()
    {
        return $this->belongsToMany(Mueble::class);
    }
}
