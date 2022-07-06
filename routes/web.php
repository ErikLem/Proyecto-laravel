<?php

use App\Http\Controllers\EstudiantesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FunctionsController;
use App\Http\Controllers\ExtrasController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfesorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Rutas Generales:
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas Administrativas:
Route::resource('registros', RegistroController::class);
Route::resource('usuarios', UserController::class);

//Funcionalidades extra:
Route::get('registros/download-pdf/{id}', [FunctionsController::class, 'downloadPdf'])->name('download-pdf');
Route::get('registro/estudiantes', [ExtrasController::class, 'index'])->name('registros.estudiantes');
Route::get('registro/estudiantes/{var}', [ExtrasController::class, 'show'])->name('registros.estudiantes.show');

Route::get('test', [TestController::class, 'index'])->name('test');

//---------------------------------------------------------------------------------------------------------------------
// Rutas para el manejo de los formularios
Route::get('formularios/nuevo-formulario', [App\Http\Controllers\FormularioController::class, 'nuevoFormulario'])->name('nuevo-formulario');

//Para consultar API de Estudiantes
Route::post('/estudiantesEPN', [EstudiantesController::class, 'indexByEPN'])->name('estudiantesEPN');
//Para consultar API de Profesores
Route::post('/profesoresEPN', [ProfesorController::class, 'indexByEPN'])->name('profesoresEPN');

// Metodos de ESTUDIANTES
// Route::get('/estudiantes', [EstudiantesController::class, 'index'])->name('estudiantes');
Route::post('/estudiantes', [EstudiantesController::class, 'store'])->name('estudiantes.insert');
// Route::patch('/estudiantes', [EstudiantesController::class, 'edit'])->name('estudiantes-edit');
// Route::delete('/estudiantes', [EstudiantesController::class, 'destroy'])->name('estudiantes.destroy');

//Metodos de PROFESORES
// Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores');
Route::post('/profesores', [ProfesorController::class, 'store'])->name('profesores.insert');
// Route::patch('/profesores', [ProfesorController::class, 'edit'])->name('profesores-edit');
// Route::delete('/profesores', [ProfesorController::class, 'destroy'])->name('profesores.destroy');

// //Metodos de Formulario
Route::get('/formulario', [FormularioController::class, 'index'])->name('formulario');
Route::post('/formulario', [FormularioController::class, 'store'])->name('formulario.insert');
Route::put('/formulario-tutor', [FormularioController::class, 'storeSubdecano'])->name('formulario.insert.tutor');
Route::put('/formulario-llenar-tutor', [FormularioController::class, 'storeTutor'])->name('formulario.insert.datos.tutor');
Route::put('/formulario-miembrocomision', [FormularioController::class, 'storeMiembrocomision'])->name('formulario.insert.miembrocomision');
Route::put('/formulario-comision', [FormularioController::class, 'storeComision'])->name('formulario.insert.comision');
Route::put('/formulario-decano', [FormularioController::class, 'storeDecano'])->name('formulario.insert.decano');
Route::delete('/formulario/{id}', [FormularioController::class, 'destroy'])->name('formulario.destroy');
Route::get('/aceptar-formulario/{id}', [FormularioController::class, 'aceptarFormulario'])->name('formulario.aceptar');
Route::get('/aceptar-formulario-tutor/{id}', [FormularioController::class, 'aceptarFormularioTutor'])->name('formulario.aceptar.tutor');
Route::get('/aceptar-formulario-miembrocpp/{id}', [FormularioController::class, 'aceptarFormularioMiembrocpp'])->name('formulario.aceptar.miembrocpp');
Route::get('/aceptar-formulario-comision/{id}', [FormularioController::class, 'aceptarFormularioComision'])->name('formulario.aceptar.comision');
Route::get('/aceptar-formulario-decano/{id}', [FormularioController::class, 'aceptarFormularioDecano'])->name('formulario.aceptar.decano');
// // Ruta para revisar los formularios en el formato original
Route::put('/revisar-formulario/{id}', [FormularioController::class, 'revisarFormulario'])->name('formulario.revisar');

// Metodo para solicitar correciones
Route::put('/formulario-corregir', [FormularioController::class, 'storeCorregir'])->name('formulario.corregir');// para comentarios de correcion
Route::get('/corregir-formulario/{id}', [FormularioController::class, 'aceptarCorregir'])->name('formulario.aceptarcorreccion'); // para aceptar la correcion
Route::put('/formulario-corregir-estudiante', [FormularioController::class, 'updateFormulario'])->name('formulario.updateformulario'); // para setear nuevas correcciones
// // Para formularios rechazados
Route::get('/formulario-rechazado', [FormularioController::class, 'indexRechazado'])->name('formulario.rechazado');
// // Para ver los formularios que ya tiene un tutor asignado
Route::get('/formulario-aceptado', [FormularioController::class, 'indexAceptado'])->name('formulario.aceptado');
// Formularios terminados Estudiante
Route::get('/formulario-completados', [FormularioController::class, 'indexCompletados'])->name('formulario.completados');
// Formularios devueltos para revision
Route::get('/formulario-devueltos', [FormularioController::class, 'indexDevueltos'])->name('formulario.devueltos');
// Formularios formularios corregidos
Route::get('/formulario-corregidos', [FormularioController::class, 'indexCorregidos'])->name('formulario.corregidos');
// //Generar PDF
Route::get('/generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('generar.pdf');