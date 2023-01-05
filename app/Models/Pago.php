<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';

    public $timestamps = false;

    protected $fillable = [
        'nro',
        'numeropago',
        'monto',
        'fecha',
        'residente_id',
        'contrato_id',
    ];

    public function residente()
    {
        return $this->belongsTo(Residente::class, 'residente_id');
    }
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }
    public function residentes()
    {
        return $this->hasMany(Contrato::class,'contrato_id');
    }
}
