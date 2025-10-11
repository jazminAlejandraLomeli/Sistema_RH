<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona_has_adicional extends Model
{
    use HasFactory;
 
    protected $table = 'persona_has_adicional';

    public function persona()
    {
        return $this->belongsTo(Personas_trabajo::class, 'id_persona', 'id');
    }

    public function distincionAdicional()
    {
        return $this->belongsTo(Distincion_Adicional::class, 'id_distincion', 'id');
    }
}
