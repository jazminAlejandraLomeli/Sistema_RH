<?php

namespace App\Services;

use App\Mail\RegistroMail;
use App\Mail\ResetearMail;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailsService  
{


    public static function newUser($Params)
    {
        try {
            // Intentar enviar el correo después del commit
            Mail::to($Params['mail'])->send(new RegistroMail($Params['Code'], $Params['Name']));
            return true;
        } catch (Exception $e) {
            // Registrar error pero no interrumpir la ejecución
            Log::error('Error al enviar correo de registro: ' . $e->getMessage());
            return false;
        }
    }
    public static function reserPassword($mail, $name, $user_name)
    {
        try {
             Mail::to($mail)->send(new ResetearMail($user_name, $name));

             return true;
        } catch (Exception $e) {
            // Registrar error pero no interrumpir la ejecución
            Log::error('Error al enviar correo de restablecimiento de contraseña: ' . $e->getMessage());
            return false;
        }
    }


}
