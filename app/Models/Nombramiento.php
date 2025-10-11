<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nombramiento extends Model
{
    use HasFactory;

    protected $table = 'nombramientos';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
    ];

    public function personasTrabajo()
    {
        return $this->hasMany(Personas_trabajo::class, 'nombramiento', 'id');
    }

  public function distincionesAdicionales()
    {
        return $this->belongsToMany(Distincion_Adicional::class, 'nombramiento_adicional', 'id_nombramiento', 'id');
    }

    public function categorias_nombramientos()
    {
        return $this->belongsToMany(Categoria::class, 'nombramiento_categorias', 'id_nombramiento', 'id_categoria');
    }



     
}
