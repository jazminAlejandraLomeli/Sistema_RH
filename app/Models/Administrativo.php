<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Administrativo extends Model
{
    use HasFactory;

    protected $table = 'administrativos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'foto_url',
        'correo', 
        'tel_emergencia',
        'telefono',
        'nombre_emergencia',
        'fecha_nacimiento',
        'fecha_ingreso',
        'sexo',
        'ultimo_grado',
        'e_parentesco',
        'estado_id', 
        'rfc',
        'nss',
        'created_by',
        'updated_by', 
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function trabajos()
    {
        return $this->hasMany(Personas_trabajo::class, 'id_persona', 'id');
    }

    public function creado()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function actualizado()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function honorario() : HasOne
    {
        return $this->hasOne(Honorario::class, 'administrativo_id','id');
    }

    public function domicilio()
    {
        return $this->hasOne(Domicilio::class, 'administrativo_id');
    }



    

   
}
