<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaComun extends Model
{
    use HasFactory;
    protected $table = 'areas_comunes';
    protected $primaryKey = ['id_edif','id'];
    protected $foreignKey = ['id_edif','id'];
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_edif',
        'id',
        'nombre',
        'precio_hora',
        'descripcion',
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'id_edif');        
    }
}
