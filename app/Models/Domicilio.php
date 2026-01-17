<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;

    protected $fillable = [
        'administrativo_id',
        'estado',
        'calle',
        'numero',
        'colonia',
        'ciudad',
        'cp',
        'created_by',
        'updated_by',
    ];

    
    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class,  'administrativo_id');
    }

 
    public function actualizado_por() // Cambiar el nombre a algo más claro
    {
        return $this->belongsTo(Administrativo::class, 'updated_by');
    }

    public function creado_por()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
    