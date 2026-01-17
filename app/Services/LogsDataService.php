<?php

namespace App\Services;

use App\Models\Administrativo;
use App\Models\Log;
use App\Models\Nombramiento;
use App\Models\Personas_trabajo;
use App\Models\User;
use Spatie\Permission\Models\Role;

class LogsDataService
{

    public static function newWorker($Code_worker, $nombre)
    {
        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::create_worker($Code_worker, $nombre);
        $Data = [
            'accion' => 'Nuevo registro',
            'descripcion' =>  $text,
            'tipo' => 'create-worker',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }
    public static function update_personal_data($id, $nombre)
    {
        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::update_worker($id, $nombre);
        $Data = [
            'accion' => 'Actualización',
            'descripcion' =>  $text,
            'tipo' => 'update-worker',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }
    public static function delete_job($Id_worker, $Id_work)
    {
        $Worker = Administrativo::find($Id_worker);
        $Job = Personas_trabajo::find($Id_work);

        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::delete_job($Worker->codigo, $Worker->nombre, $Job->nombramientoPersona->nombre);
        $Data = [
            'accion' => 'Eliminación',
            'descripcion' =>  $text,
            'tipo' => 'delete-job',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }

    public static function add_job($Id_worker, $principal, $Id_work)
    {
        $Worker = Administrativo::find($Id_worker);
        $Job = Nombramiento::find($Id_work);

        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::new_job($Worker->codigo, $Worker->nombre, $Job->nombre, $principal);
        $Data = [
            'accion' => 'Nuevo nombramiento',
            'descripcion' =>  $text,
            'tipo' => 'new-job',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }

    public static function Update_job($Id_worker, $principal, $Id_work)
    {
        $Worker = Administrativo::find($Id_worker);
        $Job = Nombramiento::find($Id_work);

        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::update_job($Worker->codigo, $Worker->nombre, $Job->nombre, $principal);
        $Data = [
            'accion' => 'Actualización',
            'descripcion' =>  $text,
            'tipo' => 'update-job',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }

    public static function switch_job($Id_worker)
    {
        $Worker = Administrativo::find($Id_worker);

        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::switch_job($Worker->codigo, $Worker->nombre);

        $Data = [
            'accion' => 'Intercambio',
            'descripcion' =>  $text,
            'tipo' => 'switch-job',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }
    /// ADDRESS
    public static function update_address($Id_worker)
    {
        $Worker = Administrativo::find($Id_worker);

        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::update_address($Worker->codigo, $Worker->nombre);
        $Data = [
            'accion' => 'Actualización',
            'descripcion' =>  $text,
            'tipo' => 'update-address',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }
    public static function create_address($Id_worker)
    {
        $Worker = Administrativo::find($Id_worker);

        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::create_address($Worker->codigo, $Worker->nombre);
        $Data = [
            'accion' => 'Registro',
            'descripcion' =>  $text,
            'tipo' => 'create-address',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }
    public static function create_user($Code, $nombre, $UserType)
    {
        $roleName = Role::find($UserType)->name;
        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::create_user($Code, $nombre,   $roleName);
        $Data = [
            'accion' => 'Registro',
            'descripcion' =>  $text,
            'tipo' => 'create-user',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }
    public static function update_user($Id, $UserType)
    {
        $user = User::find($Id);
        $Code = $user->code;
        $nombre = $user->name;
        $roleName = Role::find($UserType)->name;
        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::update_user($Code, $nombre,   $roleName);
        $Data = [
            'accion' => 'Actualización',
            'descripcion' =>  $text,
            'tipo' => 'update-user',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }
    public static function on_off_user($Id, $Status)
    {

        $user = User::find($Id);
        $Code = $user->user_name;
        $nombre = $user->name;
        $type = ($Status == 'Activo') ? 'on-user' : 'off-user';
        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::on_off_user($Code, $nombre,   $Status);
        $Data = [
            'accion' => 'Acceso al sistema',
            'descripcion' =>  $text,
            'tipo' => $type,
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }
    public static function reset_password_user($Id)
    {

        $user = User::find($Id);
        $Code = $user->user_name;
        $nombre = $user->name;
         // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::reset_password_user($Code, $nombre);
        $Data = [
            'accion' => 'Contraseña',
            'descripcion' =>  $text,
            'tipo' => 'reset-password',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }


    public static function inactive_personal($id, $nombre)
    {
        // Type es basado en el archivo config/icons-colors.php 
        $text = DescriptionLogsService::inactive_worker($id, $nombre);
        $Data = [
            'accion' => 'Inactivo',
            'descripcion' =>  $text,
            'tipo' => 'delete-worker',
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ];

        Log::create($Data);
    }
}
