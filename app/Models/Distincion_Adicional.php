<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distincion_Adicional extends Model
{
    use HasFactory;

    protected $table = 'distincion_adicional';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
    ];

    // Puedes definir relaciones aquí si las necesitas en tu aplicación

    public function nombramiento()
    {
        return $this->belongsToMany(Nombramiento::class, 'nombramiento_adicional', 'id_distincion', 'id_nombramiento');
    }

    public function personasTrabajo()
    {
        return $this->hasMany(Personas_trabajo::class, 'distincion_ad', 'id');
    }

}
