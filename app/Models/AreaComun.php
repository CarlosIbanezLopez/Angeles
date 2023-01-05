<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areacomun extends Model
{
    use HasFactory;
    protected $table = 'areacomuns';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
        'edificio_id',
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'edificio_id');
    }
    public function inventarios()
    {
        return $this->belongsToMany(Inventario::class);
    }

}
