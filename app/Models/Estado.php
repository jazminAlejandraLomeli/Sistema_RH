<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    
    protected $table = 'estados';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
    ];


    public function administrativos()
    {
        return $this->hasMany(Administrativo::class, 'estado_id');
    }

    public function personas_has_trabajo()
    {
        return $this->hasMany(Personas_trabajo::class, 'id_estado');
    }

}
