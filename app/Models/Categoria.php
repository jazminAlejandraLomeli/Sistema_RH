<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'nombre', 'genero'
    ];

    public function personas_Trabajo()
    {
        return $this->hasMany(Personas_trabajo::class, 'id_categoria');
    }

    public function nombramientos_categorias()
    {
        return $this->belongsToMany(Nombramiento::class, 'nombramiento_categorias', 'id_categoria', 'id_nombramiento');
    }
    

 
}
