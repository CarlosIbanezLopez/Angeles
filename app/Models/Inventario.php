<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;


    protected $table = 'inventarios';



    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'estado',
        'color',
        'id_mueble',
    ];
    public function mueble()
    {
        return $this->belongsTo(Mueble::class, 'id_mueble');
    }
    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class);
    }
}


