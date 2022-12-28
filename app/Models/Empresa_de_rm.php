<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa_de_rm extends Model
{
    use HasFactory;

    protected $table = 'empresas_de_rm';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'ciudad',
        'direccion',
        'telefono',
        'email'
    ];

    public function getCiudad()
    {
        if ($this->ciudad == 'PA')
            return 'Pando';
            
        if ($this->ciudad == 'BE')
            return 'Beni';

        if ($this->ciudad == 'LP')
            return 'La Paz';
            
        if ($this->ciudad == 'OR')
            return 'Oruro';

        if ($this->ciudad == 'CB')
            return 'Cochabamba';
            
        if ($this->ciudad == 'SC')
            return 'Santa Cruz';

        if ($this->ciudad == 'PO')
            return 'Potosi';
            
        if ($this->ciudad == 'CH')
            return 'Chuquisaca';

        if ($this->ciudad == 'TA')
            return 'Tarija';        
    }
}
