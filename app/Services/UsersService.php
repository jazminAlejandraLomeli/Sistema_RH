<?php

namespace App\Services;

use App\Helpers\FormatHelper;
use App\Mail\RegistroMail;
use App\Models\Administrativo;
use App\Models\Domicilio;
use App\Models\Log;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Throwable;

class UsersService
{

    public static function getUsers($Params)
    {

        $offset = $Params->input('offset', 0);
        $limit = $Params->input('limit', 10);
        $search = $Params->input('search', '');

        $query = User::with('roles')
            ->where('users.id', '!=', auth()->user()->id)
            ->whereNot('users.user_name', '010101');    // User CTA

        if (!empty($search)) {

            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%$search%")
                    ->orWhere('users.user_name', 'like', "%$search%")
                    ->orWhere('users.status', 'like', "%$search%");
            });
        }

        $total = $query->count(); // contador antes de limitar
        $users = $query->skip($offset)->take($limit)->get();

        return [
            'count' => $total,
            'results' => $users,
        ];
    }


    public static function store($Data, $mail)
    {
        try {
            $user = User::create([
                'user_name' => $Data['Code'],
                'name' => $Data['Name'],
                'password' => bcrypt(config('app.default_pass')),
            ]);

            $user->syncRoles(Role::find($Data['UserType']));  // Asignarle su rol 

        } catch (Exception $e) {
            Log::error('Error al agregar a el usuario al sistema' . $e->getMessage());
            return response()->json(['msg' => '¡Error! Hubo un error al al realizar la petición, inténtalo más tarde.', 'error' => $e->getMessage()], 404);
        }
    }
    /*
        Funcion para verificar si el usuario tiene un correo
    */
    public static function CheckEmail($code)
    {
        try {
            $administrativo = Administrativo::where('codigo', $code)->first();

            if ($administrativo->correo == null) {
                return [
                    'status' => 404,
                    'msg' => 'El usuario no cuenta con un correo registrado'
                ];
            } else {

                return [
                    'status' => 200,
                    'msg' => 'El usuario cuenta con un correo registrado',
                    'mail' => $administrativo->correo
                ];
            }
        } catch (\Throwable $th) {
            return [
                'status' => 500,
                'msg' => 'Algo salio mal al consultar el correo del usuario'
            ];
        }
    }

    /*
        Funcion para verificar si el codigo del usuario existe en la base de datos
    */
    public static function checkCode($code)
    {
        try {
            // que si exista
            $administrativo = Administrativo::where('codigo', $code)->first();

            if (!preg_match('/^[0-9]{7,10}$/', $code)) {
                return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
            }

            if (!$administrativo) {  // no existe
                return [
                    'status' => 202,
                    'msg' => 'el código ingresado no esta enlazado a ningun trabajador.'
                ];
            } else {
                // que no se repita en users
                $user = User::where('user_name', $code)->first();

                if ($user) {
                    // Si el nombre ya existe 
                    return  [
                        'status' => 202,
                        'msg' => '¡Error!, Ya existe un usuario con el código ingresado.'
                    ];
                } else {
                    $nombre = $administrativo->nombre;

                    return [
                        'status' => 200,
                        'nombre' =>  $nombre,
                        'code' => $code
                    ];
                }
            }
        } catch (\Throwable $th) {
            return [
                'status' => 500,
                'msg' => 'Algo salio mal al consultar el correo del usuario'
            ];
        }
    }
    /*
        Funcion para restablecer la contraseña de un usuario
    */
    public static function resetPassword($Id)
    {
        try {
            // Busca al usuario por el nombre de usuario

            $user = User::where('id', $Id)->first();
            $Data = Administrativo::where('nombre', $user['name'])->first();

            $user->update([
                'password' =>  bcrypt(config('app.default_pass'))
            ]);

            return [
                'email' => $Data->correo,
                'name' => $user->name,
                'user_name' => $user->user_name
            ];
        } catch (Throwable $th) {
            // TODO: Cambiar el throw
            throw $th;
        }
    }
    /*
        Funcion para inhabilitar a un usuario
    */

    public static function onOffUser($Data)
    {

        try {
            $text = ($Data['Status'] == 'Inactivo') ? " El usuario ya no podra acceder al sistema" : " El usuario podra acceder al sistema nuevamente";
            // Busca al usuario por el nombre de usuario

            $user = User::where('id', $Data['Id'])->first();

            $user->update([
                'status' =>   $Data['Status'],
            ]);

            return [
                'status' => 200,
                'msg' => '¡Éxito! ' .  $text
            ];
        } catch (Throwable $th) {
            return [
                'status' => 500,
                'msg' => 'Algo salio mal al inhabilitar a el usuario'
            ];
        }
    }
    /*
        Funcion para actualizar el rol de un usuario
    */
    public static function update($Data)
    {
        try {
            // Busca al usuario por el nombre de usuario
            $user = User::where('id', $Data['Id'])->first();

            $user->syncRoles(Role::find($Data['UserType']));

            return [
                'status' => 200,
                'msg' => '¡Éxito! El rol del usuario fue actualizado correctamente.'
            ];
        } catch (Throwable $th) {
            return [
                'status' => 500,
                'msg' => 'Algo salio mal al actualizar el rol del usuario'
            ];
        }
    }
}
