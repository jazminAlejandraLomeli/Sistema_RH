<?php

namespace App\Http\Controllers;

use App\Mail\RegistroMail;
use App\Mail\ResetearMail;
use App\Http\Requests\ResetDeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Models\User;
use App\Services\EmailsService;
use App\Services\LogsDataService;
use App\Services\UsersService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;

Carbon::setLocale('es');


class UserController extends Controller
{


    public function index()
    {

        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],
            ['name' => 'Usuarios'],
        ];

        $Roles = Role::all();
        //return response()->json($Roles);
        return view('users.index', compact('breadcrumbs', 'Roles'));      // retornar a vista users 
    }

    public function getUsers(Request $request)
    {
        try {
            $users = UsersService::getUsers($request);
            return response()->json([
                'count' => $users['count'],
                'results' => $users['results'],
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener los usuarios ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    public function get_details(ResetDeleteUserRequest $request)
    {
        $data = $request->validated();
        $usuario = User::with('roles')->find($data['Id']);

        $usuario->Created_data = $usuario->created_at->translatedFormat('j \d\e F \d\e Y');

        return response()->json(['data' => $usuario]);
    }

    /* 
        Funcion para guardar a un nuevo usuario en la base de datos ademas el codigo del usuario que se prentende   
            
    */
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();
            // Verificar si el usuario tiene un correo
            $mail = UsersService::CheckEmail($data['Code']);

            if ($mail['status'] != 200) {
                return response()->json(['msg' => '¡Error!' . $mail['msg']], $mail['status']);
            }

            DB::beginTransaction();
            UsersService::store($data, $mail['mail']);
            LogsDataService::create_user($data['Code'], $data['Name'], $data['UserType']);

            DB::commit();

            // Eviar correo
            $response =  EmailsService::newUser($data);
            $msg = "¡Éxito! el usuario fue agregado al sistema";

            if (!$response) {
                $msg .= " pero no se pudo enviar el correo de confirmación. ";
            }
            return response()->json(['msg' => $msg], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al agregar a el usuario al sistema' . $e->getMessage());
            return response()->json(['msg' => '¡Error! Hubo un error al al realizar la petición, inténtalo más tarde.', 'error' => $e->getMessage()], 404);
        }
    }

    /* 
        Funcion para buscar el nombre del usuario segun el codigo que se escribio 
    */
    public function CheckUsers(Request $request)
    {
        try {
            $data = $request->validate([
                'code' => 'required',
            ]);

            $Request = UsersService::checkCode($data['code']);

            if ($Request['status'] != 200) {
                return response()->json(['msg' => '¡Error!' . $Request['msg']], $Request['status']);
            }

            return response()->json(['status' => 200, 'msg' =>  $Request['nombre'], 'code' => $Request['code']]);
        } catch (Exception $e) {
            Log::error('Error al verificar el usuario ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    /*
        Funcion para resetear la contraseña de un usuario.
    */
    public function resetPassword(ResetDeleteUserRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $User = UsersService::resetPassword($data['Id']);
            LogsDataService::reset_password_user($data['Id']);

            DB::commit();
            $response =  EmailsService::reserPassword($User['email'], $User['name'], $User['user_name']);
            $msg = "¡Éxito! se restablecio la contraseña del usuario";

            if (!$response) {
                $msg .= " pero no se pudo enviar el correo de restablecimiento de contraseña. ";
            }
            return response()->json(['status' => 200, 'msg' => $msg]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al restablecer la contraseña' . $e->getMessage());
            return response()->json(['msg' => '¡Error! Hubo un error al al realizar la petición, inténtalo más tarde.', 'error' => $e->getMessage()], 404);
        }
    }

    /*
       Funcion para dar o quitar acceso a los usuarios al sistema 
    */
    public function On_Off_User(ResetDeleteUserRequest $request)
    {
        if (Auth::check()) {
            $data = $request->validated();
            try {
                DB::beginTransaction();
                $response =  UsersService::onOffUser($data);
                LogsDataService::on_off_user($data['Id'], $data['Status']);
                DB::commit();
                return response()->json(['status' => $response['status'], 'msg' => $response['msg']]);
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Error al Otorgar/Quitar acceso al sistema a un usuario' . $e->getMessage());
                return response()->json(['msg' => '¡Error! Hubo un error al al realizar la petición, inténtalo más tarde.', 'error' => $e->getMessage()], 404);
            }
        }
    }

    /*
    Funcion para editar el rol del usuario, de admin a lectura o viceversa 
*/
    public function Update(UpdateUserRequest $request)
    {
        if (Auth::check()) {
            $data = $request->validated();
            try {
                DB::beginTransaction();
                $response = UsersService::update($data);
                LogsDataService::update_user($data['Id'], $data['UserType'], $data['UserType']);

                DB::commit();
                return response()->json(['status' => $response['status'], 'msg' => $response['msg']]);
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Error al actualizar el rol del usuario' . $e->getMessage());
                return response()->json(['msg' => '¡Error! Hubo un error al al realizar la petición, inténtalo más tarde.', 'error' => $e->getMessage()], 404);
            }
        }
    }
}
