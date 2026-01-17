<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cumpleanos extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'created_by',
    ];


    public function creado_por()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
