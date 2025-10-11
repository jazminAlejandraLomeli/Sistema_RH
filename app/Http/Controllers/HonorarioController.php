<?php

namespace App\Http\Controllers;

use App\Helpers\FormatHelper;
use App\Models\Honorario;
use Illuminate\Http\Request;
use App\Models\Administrativo;
use App\Helpers\GeneralFunction;
use App\Http\Requests\HonorarioRequest;
use App\Http\Requests\HonorarioUpdateRequest;
use App\Models\Estado;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HonorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],
            ['name' => 'Honorarios'],
        ];

        return view('honorarios.index', compact('breadcrumbs'));
    }


    public function getWorkers(Request $request)
    {

        try{

        
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = Administrativo::with('estado', 'honorario')->whereHas('honorario');

        /* Busca por nombre, codigo, sexo o estado */
        if (!empty($search)) {
            $offset = 0;
            $query->where(function ($q) use ($search) {
                $q->where('codigo', 'like', "%$search%")
                    ->orWhere('nombre', 'like', "%$search%")
                    // Buscar por nombre en la tabla "estados" (activo, inactivo, etc.)
                    ->orWhereHas('estado', function ($subQuery) use ($search) {
                        $subQuery->where('nombre', 'like', "%$search%");
                    })
                    ->orWhereHas('honorario', function ($subQuery) use ($search) {
                        $subQuery->where('area', 'like', "%$search%")->where('responsable', 'like', "%$search%");
                    });
            });
        }

        /* Contador de la consulta */
        $total_Personas = $query->count();
        $personas = $query->skip($offset)
            ->take($limit)
            ->get();
        return response()->json(['count' => $total_Personas, 'results' => $personas]);

        }catch(Exception $e){
            Log::error('Error al obtener los datos del honorario ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }


    public function Honorario_detalles($id)
    {
        try {
        $hasHonorario = Administrativo::whereHas('honorario')
            ->where('id', $id)
            ->exists();

        if (!$hasHonorario) {
            return redirect('/honorarios');
        }


        $Persona = Administrativo::with('estado', 'honorario')->where('id', $id)->first();
        
        $fechaActual = now();        

        $Persona->edad = $fechaActual->diff($Persona->fecha_nacimiento)->y;
        $Persona->antiguedad = $fechaActual->diff($Persona->fecha_ingreso)->y;

        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],
            ['name' => 'honorarios', 'url' => route('honorario.index')],
            ['name' => 'Detalles'],
        ];

        $llenadoFormulario = GeneralFunction::obtenerDatosFormularioPersonal();


        $datosSelecionado = (object)[
            'genero' => GeneralFunction::obtenerDatosSexoSeleccionado($Persona->sexo),
            'grado_estudios' => GeneralFunction::obtenerDatosGradoSeleccionado($Persona->ultimo_grado),
        ];
        
        /* Mandar los datos a la vista */
        return view(
            'honorarios.details.show-details',

            compact('breadcrumbs', 'Persona','llenadoFormulario','datosSelecionado')
        );
        }catch(Exception $e){
            Log::error('Error al obtener los datos del honorario ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],
            ['name' => 'Honorarios', 'url' => route('honorario.index')],
            ['name' => 'Agregar honorario']
        ];

        $codigo = GeneralFunction::generarCodigoUnico();
        $llenadoFormulario = GeneralFunction::obtenerDatosFormularioPersonal();

        return view('honorarios.create', compact('breadcrumbs', 'codigo', 'llenadoFormulario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HonorarioRequest  $request)
    {
        try {

            DB::beginTransaction();

            $gender  = FormatHelper::getSexo($request->input('gender'));
            $degree_of_studies = FormatHelper::getGrado($request->input('degree_of_studies'));

            $status = Estado::where('nombre', 'LIKE', '%Activo%')->first('id');

            $administrativo = Administrativo::create([
                'codigo' => $request->input('code'),
                'nombre' => $request->input('name'),
                'correo' => $request->input('email'),
                'sexo' => $gender,
                'ultimo_grado' => $degree_of_studies,
                'fecha_nacimiento' => $request->input('birthdate'),
                'fecha_ingreso' => $request->input('entry_date'),
                'estado_id' => $status->id
            ]);

            $administrativo->honorario()->create([
                'area' => $request->input('area'),
                'responsable' => $request->input('responsible'),
                'rfc' => $request->input('rfc'),
            ]);

            DB::commit();

            return response()->json([
                'msg' => 'El registro de honorario se ha creado con éxito'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar el honorario ' . $e->getMessage());
            return response()->json([
                'error' => 'Hubo un error al guardar el registro del honorario'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Honorario $honorario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrativo $administrativo)
    {
        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],
            ['name' => 'Honorarios', 'url' => route('honorario.index')],
            ['name' => 'Editar']
        ];

        $honorario = $administrativo->load('honorario');
        $llenadoFormulario = GeneralFunction::obtenerDatosFormularioPersonal();


        $datosSelecionado = (object)[
            'genero' => GeneralFunction::obtenerDatosSexoSeleccionado($honorario->sexo),
            'grado_estudios' => GeneralFunction::obtenerDatosGradoSeleccionado($honorario->ultimo_grado),
        ];

        return view('honorarios.edit', compact('honorario', 'breadcrumbs', 'llenadoFormulario', 'datosSelecionado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HonorarioUpdateRequest $request, Administrativo $administrativo)
    {
        try {

            DB::beginTransaction();

            $gender  = FormatHelper::getSexo($request->input('gender'));
            $degree_of_studies = FormatHelper::getGrado($request->input('degree_of_studies'));

            $status = Estado::where('nombre', 'LIKE', '%Activo%')->first('id');

            $administrativo->update([
                'nombre' => $request->input('name'),
                'correo' => $request->input('email'),
                'sexo' => $gender,
                'ultimo_grado' => $degree_of_studies,
                'fecha_nacimiento' => $request->input('birthdate'),
                'fecha_ingreso' => $request->input('entry_date'),
                'estado_id' => $status->id
            ]);

            

            $administrativo->honorario()->update([
                'area' => $request->input('area'),
                'responsable' => $request->input('responsible'),
                'rfc' => $request->input('rfc'),
            ]);

            DB::commit();

            return response()->json([
                'msg' => 'El registro de honorario se ha actualizado con éxito'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar el honorario ' . $e->getMessage());
            return response()->json([
                'error' => 'Hubo un error al actualizar el registro del honorario'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Honorario $honorario)
    {
        //
    }
}
