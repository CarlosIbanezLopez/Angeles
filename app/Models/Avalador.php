<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avalador extends Model
{
    use HasFactory;

    protected $table = 'avaladores';

    protected $primaryKey = 'ci';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'ci',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'telefono',
        'email',
        'direccion'
    ];
    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
