<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notasalida extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'notasalidas';

    public $timestamps = false;

    protected $fillable = [
        'nro',
        'motivo',
    ];
    public function inventarios()
    {
        return $this->belongsToMany(Inventario::class);
    }
}
