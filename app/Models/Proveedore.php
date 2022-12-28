<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    use HasFactory;
    protected $table = 'proveedores';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'telefono',
        'ciudad',
        'direccion',
        'email',
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

