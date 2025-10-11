<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPhotoRequest;
use App\Models\Administrativo;
use App\Models\Jerarquia;
use App\Models\Personas_trabajo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class DesignerController extends Controller
{
    //

    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],            
            ['name' => 'Diseñador']
        ];
        return view('designer.index', compact('breadcrumbs'));
    }

    public function uploadPhoto(UploadPhotoRequest $request)
    {
        try {

            DB::beginTransaction();

            $code = $request->input('code');

            $administrative = Administrativo::where('codigo', $code)->first();

            if ($administrative->foto_url && Storage::exists('private/photos/' . $administrative->foto_url)) {
                Storage::delete('private/photos/' . $administrative->foto_url);
            }

            $photo = $request->file('photo');
            $path = $photo->store('private/photos');
            $name = basename($path);
            $administrative->update([
                'foto_url' => $name
            ]);

            DB::commit();

            return response()->json([
                'msg' => 'La foto se guardó correctamente'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Hubo un error al subir la foto de la persona ' . $e->getMessage());
            return response()->json([
                'error' => 'Hubo un error inesperado al subir la foto del trabajdor. Por favor intente mas tarde'
            ], 500);
        }
    }

public function showPhoto($photo)
    {
        $path = storage_path('app/private/photos/' . $photo);
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function destroy($code)
    {
        try {
            $administrative = Administrativo::where('codigo', $code)->first();

            if (!$administrative) {
                return response()->json([
                    'msg' => 'No se encontró ningun registro'
                ], 404);
            }

            if (!$administrative->foto_url) {
                return response()->json([
                    'msg' => 'La persona no tiene una foto guardada en su registro'
                ], 401);
            }

            DB::beginTransaction();

            Storage::delete('private/photos/' . $administrative->foto_url);

            $administrative->update([
                'foto_url' => null
            ]);

            DB::commit();

            return response()->json([
                'msg' => 'Foto elimina con éxito'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Hubo un error al eliminar la foto de la persona ' . $e->getMessage());
            return response()->json([
                'error' => 'Hubo un error inesperado al eliminar la foto del trabajdor. Por favor intente mas tarde'
            ], 500);
        }
    }

        
}
