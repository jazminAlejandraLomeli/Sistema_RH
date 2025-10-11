<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function persona_trabajo() : BelongsToMany
    {
        return $this->belongsToMany(Personas_trabajo::class,'profesor_asignatura_departamentos','departamento_id','persona_trabajo_id');
    }
}
