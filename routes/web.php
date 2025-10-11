<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\Personas_TrabajoController;
use App\Http\Controllers\AddPersonController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HonorarioController;
use App\Models\Honorario;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

//Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    /* Vista de Home */

    Route::prefix('/home')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home.index');
        Route::post('/detailsPeople', [HomeController::class, 'CountDetailsPeople'])->name('detailsPeople');
    });

    Route::prefix('/perfil')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/Verify-password', [ProfileController::class, 'verifyPass'])->name('Verify-password');
        Route::post('/Change-password', [ProfileController::class, 'ChangePassword'])->name('Change-password');
    });


    /* Ver datos de personal */
    Route::prefix('/personal')->group(function () {
        Route::get('/', [PersonasController::class, 'index'])->name('personal.index');        
        Route::get('/obt-personal', [PersonasController::class, 'getWorkers'])->name('personal.getWorkers');
        /* Mostrar detalles de un registro */
        Route::get('/detalles/{codigo}', [Personas_TrabajoController::class, 'mostrarDetalles'])->name('detalles.mostrar');

        // Rutas que requieren privilegios de administrador
        Route::middleware('checkPrivileges:Administrador')->group(function () {

            Route::put('/editar-datos/{id}', [PersonasController::class, 'updatePerson'])->name('personal.details.update.personaldata');
            Route::post('/distincion-adicional', [AddPersonController::class, 'search_distincion'])->name('personal.details.distincion-adicional');      /* Jalar datos para formulario */
            Route::put('/editar-Nombra/{id}', [Personas_TrabajoController::class, 'editarNomb'])->name('editar-Nombra');
            Route::post('/Agregar-Nom', [Personas_TrabajoController::class, 'guardarNombramiento'])->name('Agregar-Nom');      /* Editar datos de los nombramientos */
            //Agregar Personal
            Route::get('/agregar_personal', [AddPersonController::class, 'index'])->name('personal.agregar_personal');
            Route::post('/searchCode', [AddPersonController::class, 'Search_Code'])->name('searchCode');   /* Verifica que el codigo no choque con otro */
            Route::post('/guardar-Personal', [AddPersonController::class, 'guardarPersonal'])->name('personal.store');
        });
    });


    Route::middleware('checkPrivileges:Administrador')->group(function () {
        Route::prefix('/usuarios')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/get-users', [UserController::class, 'getUsers'])->name('users.getUsers');
            Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
            Route::post('/On_Off_User', [UserController::class, 'On_Off_User'])->name('users.delete');
            Route::post('/get_details', [UserController::class, 'get_details'])->name('users.get_details');
            Route::post('/verificar-codigo', [UserController::class, 'CheckUsers'])->name('users.verificar-codigo');
            Route::post('/agregar-usuario', [UserController::class, 'store'])->name('agregar-usuario');
            Route::post('/editar-usuario', [UserController::class, 'Update'])->name('users.editar-usuario');
        });

        Route::post('/editar-usuario', [UserController::class, 'Update'])->name('editar-usuario');
        Route::put('/eliminar-nombramiento', [Personas_TrabajoController::class, 'eliminarNomb'])->name('eliminar-nombramiento');
        Route::put('/cambiar-nombramiento', [Personas_TrabajoController::class, 'cambiarNombramiento'])->name('cambiar-nombramiento');

        // Routas para el módulo de administrativos
        Route::prefix('/honorarios')->group(function () {
            Route::get('/', [HonorarioController::class, 'index'])->name('honorario.index');
            Route::get('/obt-honorarios', [HonorarioController::class, 'getWorkers'])->name('honorarios.getWorkers');
            Route::get('/detalles/{codigo}', [HonorarioController::class, 'Honorario_detalles'])->name('honorarios.detalles.mostrar');
            Route::get('/crear', [HonorarioController::class, 'create'])->name('honorarios.create');
            Route::post('/guardar', [HonorarioController::class, 'store'])->name('honorarios.store');
            Route::put('/{administrativo}/actualizar', [HonorarioController::class, 'update'])->name('honorarios.update');
        });
    });

    Route::middleware('checkPrivileges:Designer')->group(function () {
        Route::prefix('/fotos')->group(function () {
            Route::get('/', [DesignerController::class, 'index'])->name('designer.index');
            Route::post('/subir-foto', [DesignerController::class, 'uploadPhoto'])->name('designer.update');
            Route::get('/obtener-foto/{photo}', [DesignerController::class, 'showPhoto'])->name('designer.show');
            Route::delete('/eliminar-foto/{code}', [DesignerController::class, 'destroy'])->name('designer.delete');
        });

        Route::get('/api/designer/get-workers', [PersonasController::class, 'getWorkersDesigner'])->name('designer.get.workers');
    });

    Route::middleware('checkPrivileges:Lectura')->group(function () {
        Route::get('/api/directory/get-workers', [PersonasController::class, 'getWorkersDirectory'])->name('directory.get.workers');
        Route::get('/directorio', [DirectoryController::class, 'index'])->name('directory.index');
        Route::get('/directorio/obtener-foto/{photo}', [DesignerController::class, 'showPhoto'])->name('designer.get.photo');
    });

    
    


    // Route::get('/directorio',[DesignerController::class,''])->name('directory.index');
    // Route::get('/obtener-directorio',[PersonasController::class,''])->name('directory.get.directory');



    // ///ROL DE ADMINISTRADOR 
    // Route::middleware('checkPrivileges:Administrador')->group(function () {
    //     Route::post('/editar-usuario', [UserController::class, 'Update'])->name('editar-usuario');
    //     Route::put('/eliminar-nombramiento/{id}', [Personas_TrabajoController::class, 'eliminarNomb'])->name('eliminar-nombramiento');
    //     Route::put('/cambiar-nombramiento/{id}', [Personas_TrabajoController::class, 'cambiarNombramiento'])->name('cambiar-nombramiento');
    // });
});

Route::get('/foto/{photo}', [DesignerController::class, 'showPhoto'])->name('designer.update');

