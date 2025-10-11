<?php

namespace App\Http\Controllers;

use App\Mail\RegistroMail;
use App\Mail\ResetearMail;
use App\Http\Requests\ResetDeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Models\User;
use App\Models\Administrativo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');


        $query = User::with('roles')
            ->where('users.id', '!=', auth()->user()->id)
            ->whereNot('users.user_name', '010101');

        if (!empty($search)) {

            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%$search%")
                    ->orWhere('users.user_name', 'like', "%$search%")
                    ->orWhere('users.status', 'like', "%$search%");
            });
        }

        $total = $query->count(); // contador antes de limitar
        $users = $query->skip($offset)->take($limit)->get();

        return response()->json([
            'count' => $total,
            'results' => $users,
        ]);
        }catch(Exception $e){
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
            agregar debe estar en la tabla de administrativos, de lo contrario no te dejara agregarlo tambien si ya existe 
                un usuario con ese codigo tamnien lo notificará 
    */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        try {
            $administrativo = Administrativo::where('codigo', $data['Code'])->first();

            if ($administrativo->correo == null) {
                return response()->json(['msg' => "El usuario no cuenta con un correo"], 404);
            }
             $mail = $administrativo->correo;

            DB::beginTransaction();

            $user = User::create([
                'user_name' => $data['Code'],
                'name' => $data['Name'],
                'password' => bcrypt(config('app.default_pass')),
            ]);
            //  $role = ; //Buscar si el rol existe

            $user->syncRoles(Role::find($data['UserType']));  // Asignarle su rol 
            // Mail::to($mail)->send(new RegistroMail($data['Code'], $data['Name']));
            DB::commit();
            return response()->json(['msg' => '¡Éxito! el usuario fue agregado al sistema.'], 200);
        } catch (\Exception $e) {
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

        $username = $data['code'];
        if (!preg_match('/^[0-9]{7,10}$/', $username)) {
            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
        }

        $Administrativo = Administrativo::where('codigo', $username)->first();
        if (!$Administrativo) {
            // Si el nombre ya existe 
            return response()->json(['status' => 202, 'msg' => '¡Error!, el código ingresado no esta enlazado a ningun trabajador.']);
        } else {
            $user = User::where('user_name', $username)->first();
            if ($user) {
                return response()->json(['status' => 202, 'msg' => '¡Error!, Ya existe un usuario con el código ingresado.']);
            } else {
                $nombre = $Administrativo->nombre;
                // Si el nombre ya existe 
                return response()->json(['status' => 200, 'msg' =>  $nombre, 'code' => $username]);
            }
        }
    }catch(Exception $e){
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
            // Busca al usuario por el nombre de usuario
            $user = User::where('id', $data['Id'])->first();
            $Data = Administrativo::where('nombre', $user['name'])->first();
            $mail = $Data->correo;

 
            $user->update([
                'password' =>  bcrypt(config('app.default_pass'))
            ]);
            DB::commit();
            if ($mail) {
                // Envío de correo electrónico
                Mail::to($mail)->send(new ResetearMail($user['user_name'], $user['name']));
            }

            return response()->json(['status' => 200, 'msg' => '¡Éxito! La contraseña se restablecio exitosamente.']);
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
            $text = ($data['Status'] == 'Inactivo') ? " El usuario ya no podra acceder al sistema" : " El usuario podra acceder al sistema nuevamente";
            try {
                DB::beginTransaction();
                // Busca al usuario por el nombre de usuario
                $user = User::where('id', $data['Id'])->first();

                //Falta poner lo de los usuarios
                $user->update([
                    'status' =>   $data['Status'],
                ]);
                DB::commit();
                return response()->json(['status' => 200, 'msg' => '¡Éxito! ' .  $text]);
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
                // Busca al usuario por el nombre de usuario
                $user = User::where('id', $data['Id'])->first();

                $user->syncRoles(Role::find($data['UserType']));

                DB::commit();
                return response()->json(['status' => 200, 'msg' => '¡Éxito! El rol del usuario fue actualizado correctamente.']);
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Error al actualizar el rol del usuario' . $e->getMessage());
                return response()->json(['msg' => '¡Error! Hubo un error al al realizar la petición, inténtalo más tarde.', 'error' => $e->getMessage()], 404);
            }
        }
    }
}
