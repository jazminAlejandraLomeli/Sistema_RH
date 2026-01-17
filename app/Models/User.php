<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;   // separacion de usuarios


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_name',
        'password',
        'status',
        'created_at',
        'updated_at',
        'created_by'
    ];


    protected $hidden = [
        'password', // Oculta el campo de la contraseña
        'remember_token',
    ];

    public function usuario_creado()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    public function administrativo_creado()
    {
        return $this->hasMany(Administrativo::class, 'created_by');
    }

    public function administrativo_actualizado()
    {
        return $this->hasMany(Administrativo::class, 'updated_by');
    }

    public function p_t_creado()
    {
        return $this->hasMany(Personas_trabajo::class, 'created_by');
    }

    public function p_t_actualizado()
    {
        return $this->hasMany(Personas_trabajo::class, 'updated_by');
    }

    public function domicilio_creado()
    {
        return $this->hasMany(Domicilio::class, 'created_by');
    }

    public function domicilio_actualizado()
    {
        return $this->hasMany(Domicilio::class, 'updated_by');
    }

    public function log()
    {
        return $this->hasMany(Log::class, 'created_by');
    }
    public function cumpleanos()
    {
        return $this->hasMany(Cumpleanos::class, 'created_by');
    }
}
