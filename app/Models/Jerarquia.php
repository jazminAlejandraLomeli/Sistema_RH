<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Jerarquia extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_distincion',
        'jerarquia'
    ];
 
    // public function trabajos() : BelongsToMany
    // {
    //     return $this->belongsToMany(Personas_trabajo::class,'area_trabajador', 'jerarquia_id','trabajo_id');
    // }

    public function trabajos(): BelongsTo 
    {
        return $this->belongsTo(Personas_trabajo::class, 'area_distincion', 'area_distincion');
    }
}
