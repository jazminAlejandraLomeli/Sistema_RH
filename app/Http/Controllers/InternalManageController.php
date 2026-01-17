<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use App\Models\Log;
use App\Http\Requests\CodeValidation;
use App\Http\Requests\GetCategories;
use App\Models\Categoria;
use App\Models\persona_has_adicional;
use Illuminate\Http\Request;

class InternalManageController extends Controller
{
    /* Validar que el código agregado no se repita */
    public function Search_Code(CodeValidation $request)
    {
        try {

            $Persona = Administrativo::where('codigo', $request->Codigo)->first();

            if ($Persona) {
                return response()->json(['status' => false, 'msg' => 'El código ya esta enlazado a otra persona.']);
            } else {
                return response()->json(['status' => true, 'msg' => 'El código esta disponible.']);
            }
        } catch (\Exception $e) {
            Log::error('Error al buscar el código' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }

    /*
        Verificar que el codigo no choque con otro al hacer el update de una persona
    */
    public function verifyCode(Request $request)
    {
        try {

            $Persona = Administrativo::where('codigo', $request->Codigo)->first();

            if ($Persona) {
                return response()->json(['status' => false, 'msg' => 'El código ya esta enlazado a otra persona.']);
            } else {
                return response()->json(['status' => true, 'msg' => 'El código esta disponible.']);
            }
        } catch (\Exception $e) {
            Log::error('Error al buscar el código' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }


    public function getCategories(GetCategories $request)
    {

        try {


            $genero = intval($request->Genero);

            // Genero --> 1 masculino  2  femenino  3 ambos
            $categorias = [];
            $distinciones = [];
            $SQL_cate = Categoria::where('id_nombramiento', $request->Id_nombramiento)
                ->where(function ($query) use ($genero) {
                    $query->where('genero', $genero)
                        ->orWhere('genero', 3);
                })
                ->get();

            foreach ($SQL_cate as $categoria) {
                $categorias[] = [
                    'id' =>  $categoria->id,
                    'nombre' => $categoria->nombre,
                ];
            }

            if ($request->Distincion == 1) {
                $distinciones = persona_has_adicional::with('distincionAdicional')
                    ->where('id_nombramiento', $request->Id_nombramiento)
                    ->get();
            }
            return response()->json(['status' => 200, 'Categorias' => $categorias, 'Adicional' => $distinciones]);
        } catch (\Exception $e) {
            Log::error('Error al buscar la distinción' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Error al buscar las categorías del nombramiento.', 'error' => $e->getMessage()], 404);
        }



       
    }
}
