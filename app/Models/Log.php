<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'accion',
        'descripcion',
        'created_by',
        'tipo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /* Escapar html y mostrar estilos */
    public function getDescripcionAttribute($value)
    {
        return new HtmlString($value);
    }
}
