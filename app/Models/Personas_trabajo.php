<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Personas_trabajo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'personas_trabajo';
    protected $primaryKey = 'id';
    public $incrementing = true;
   // public $incrementing = false; // Para indicar que la clave primaria no es autoincremental

    protected $fillable = [
        'id_persona',
        'codigo',
        'principal',
        'nombramiento',
        'horas_trabajo',
        'turno',
        'horario_oficial',
        'horario_actual',
        'tipo_contrato',
        'fecha_termino',
        'distincion_ad',
        'id_categoria',
        'id_estado',
        'area_distincion',
        'semblanza',
        'created_by',
        'updated_by',
    ];

    // Relaciones
    public function nombramientoPersona()
    {
        return $this->belongsTo(Nombramiento::class, 'nombramiento', 'id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado' );
    }

    public function distincionAdicional()
    {
        return $this->belongsTo(Distincion_Adicional::class, 'distincion_ad', 'id');
    }

    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class, 'id_persona');
    }

    public function trabajoCategoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'personas_trabajo_categorias', 'id_persona_trabajo', 'id_categoria');
    }
    
    public function creado()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function actualizado()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relacion con la tabla de departamentos
    public function departamento() : BelongsToMany
    {
        return $this->belongsToMany(Departamento::class, 'profesor_asignatura_departamentos','persona_trabajo_id','departamento_id');
    }

    public function jerarquia() : HasOne 
    {
        return $this->hasOne(Jerarquia::class,'area_distincion','area_distincion');
    }

    // public function jerarquias () : BelongsToMany
    // {   
    //     return $this->belongsToMany(Jerarquia::class,'area_trabajador','trabajo_id','jerarquia_id');
    // }
    

}
