<?php

namespace App\Services;

use App\Helpers\FormatHelper;
use App\Models\Administrativo;
use App\Models\Domicilio;

class DescriptionLogsService
{

    public static function create_worker($Code_worker, $nombre)
    {
        $text = 'Se dió de alta a un nuevo trabajador con el nombre <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b> al sistema.';
        return $text;
    }
    public static function update_worker($Code_worker, $nombre)
    {
        $text =  'Se realizó un cambio en los datos personales del trabajador <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>.';
        return $text;
    }
    public static function inactive_worker($Code_worker, $nombre)
    {
        $text =  'Se cambio el estado laboral a <b class="text-danger"> INACTIVO </b> para la persona <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>.';
        return $text;
    }
    public static function delete_job($Code_worker, $nombre, $nombramiento)
    {
        $text =  'Se eliminó el nombramiento de <b class="text-danger">' . $nombramiento . '</b> al trabajador <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>.';
        return $text;
    }
    public static function new_job($Code_worker, $nombre, $nombramiento, $principal)
    {
        if ($principal == 0) {
            $text =  'Se agregó un nombramiento secundario de <b class="text-success">' . $nombramiento . '</b> al trabajador <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>.';
        } else {
            $text =  'Se agregó el nombramiento principal de <b class="text-success">' . $nombramiento . '</b> al trabajador <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>.';
        }
        return $text;
    }
    public static function update_job($Code_worker, $nombre, $nombramiento, $principal)
    {
        if ($principal == 0) {
            $text =  'Se actualizó un nombramiento secundario de <b class="text-success">' . $nombramiento . '</b> al trabajador <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>.';
        } else {
            $text =  'Se actualizó el nombramiento principal de <b class="text-success">' . $nombramiento . '</b> al trabajador <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>.';
        }
        return $text;
    }

    public static function switch_job($Code_worker, $nombre)
    {
        $text =  'Se intercambiaron los nombramientos al trabajador <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>. El nombramiento principal pasó a ser el secundario, y el secundario pasó a ser el principal.';
        return $text;
    }
    public static function update_address($Code_worker, $nombre)
    {
        $text =  'Se actualizó el domicilio del trabajador <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>.';
        return $text;
    }
    public static function create_address($Code_worker, $nombre)
    {
        $text =  'Se agrego el domicilio del trabajador <i class="text-primary">' . $nombre . '</i> con el código <b>' . $Code_worker . '</b>.';
        return $text;
    }
    public static function create_user($Code_worker, $name, $rol)
    {
        $text = 'Se agregó el usuario para <i class="text-primary">' . $name . '</i> con el rol <i class="text-success">' . $rol . '</i> y el código <b>' . $Code_worker . '</b>.';


        return $text;
    }
    public static function update_user($Code_worker, $name, $rol)
    {
        $text = 'Se actualizó el usuario de <i class="text-primary">' . $name . '</i> con el rol <i class="text-success">' . $rol . '</i> y el código <b>' . $Code_worker . '</b>.';
        return $text;
    }
    public static function on_off_user($code, $name, $status)
    {
        if ($status == 'Activo') {

            $text = 'Se actualizó el estado a <b class="text-success">' . $status . '</b> a el usuario de <i class="text-primary">' . $name . '</i> con el nombre de usuario <b>' . $code . '</b>.';
            // 'Se <b class="text-success"> permitio </b> el acceso a el usuario de <i class="text-primary">' . $name . '</i> con el estado <i class="text-success">' . $status . '</i> y el código <b>' . $code . '</b>.';
        } else {

            $text = 'Se actualizó el estado a <b class="text-danger">' . $status . '</b> a el usuario de <i class="text-primary">' . $name . '</i> con el nombre de usuario <b>' . $code . '</b>.';
        }
        return $text;
    }
    public static function reset_password_user($code, $name)
    {
        $user = auth()->user()->name;
        $text = 'El usuario de <b class="text-success">' . $user . '</b> reseteo la contraseña del usuario <i class="text-primary">' . $name . '</i> con el nombre de usuario <b>' . $code . '</b>.';
        return $text;
    }
}
