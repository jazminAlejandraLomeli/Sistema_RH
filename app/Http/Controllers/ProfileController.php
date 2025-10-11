<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {

        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],
            ['name' => 'Mi perfil'],
        ];

        $usuario = Auth::user();
        $usuario->role = $usuario->roles->first()->name;
        $usuario->Created_data = Carbon::parse($usuario->created_at)->locale('es')->isoFormat('LL');


        //return response()->json($Roles);
        return view('profile.index', compact('breadcrumbs', 'usuario'));      // retornar a vista users 
    }


    /*
        Funcion para verificar que la contraseña que se ingreso coincide con la que se ingreso
    */
    public function verifyPass(Request $request)
    {
        try {
            $data = $request->validate([
                'Contraseña' => 'required',
            ]);

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,})$/', $data['Contraseña'])) {
                return response()->json(['msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.'], 400);
            }

            // Verificamos si la contraseña coincide 
            if (Hash::check($data['Contraseña'], auth()->user()->password)) {
                return response()->json(['status' => 200, 'msg' => 'correcto']);
            } else {
                return response()->json(['msg' => 'La contraseña  no coincide con la contraseña actual.'], 404);
            }
        } catch (Exception $e) {
            Log::error('Error al verificar la contraseña ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    /*
        Funcion para cambiar la contraseña de la sesion
    */
    public function ChangePassword(Request $request)
    {
        $data = $request->validate([
            'Contraseña' => 'required',

        ]);

        $pass = $data['Contraseña'];
        // Validamos que tengan la estructura
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,})$/', $pass)) {
            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
        }
        try {
            DB::transaction(
                function () use ($pass) {
                    $usuario = User::find(auth()->user()->id);
                    $usuario->password = Hash::make($pass);
                    $usuario->save();
                }
            );
            DB::commit();
            return response()->json(['status' => 200, 'msg' => '¡Éxito! Se cambio la contraseña con exito, espera a que la página se recarge. ']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar la contraseña ' . $e->getMessage());
            return response()->json(['msg' => '¡Error! Hubo un error al actualizar la contraseña.'], 404);
        }
    }
}
