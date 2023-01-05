<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parqueo extends Model
{
    use HasFactory;
    protected $table = 'parqueos';

    public $timestamps = false;

    protected $fillable = [
        'nro',
        'piso',
        'detalle',
        'departamento_id',
        'edificio_id',
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'edificio_id');
    }
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

}
