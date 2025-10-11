<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Honorario extends Model
{
    use HasFactory;

    protected $fillable = [
        'rfc',
        'area',
        'responsable',    
        'administrativo_id'
    ];

    public function administrativo() : BelongsTo
    {
        return $this->belongsTo(Administrativo::class, 'administrativo_id','id');
    }
}
