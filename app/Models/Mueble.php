<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mueble extends Model
{
    use HasFactory;
    protected $table = 'muebles';

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'descripcion',
        'precio',
        'colores',
        'categoria_id',
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function marcas()
    {
        return $this->belongsToMany(Marca::class);
    }

    public function notacompras()
    {
        return $this->belongsToMany(Notacompra::class);
    }
}
