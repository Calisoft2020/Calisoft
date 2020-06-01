<?php
require_once "admin-api.php";
require_once "evaluator-api.php";
require_once "student-api.php";

 // Consulta y crea notificaiones 
Route::resource('notificaciones', 'NotificationController', [
    'only' => ['index', 'store']
]);

// Inicio consulta y cambio de estado de los proyectos
Route::prefix('proyectos/{proyecto}')->group(function () {
    Route::put('propuesta', 'ProyectoController@propuesta'); // Enviar proyecto como propuesta (Estudiante)
    Route::put('aceptar', 'ProyectoController@aceptar'); // Aceptar el proyecto (Admin)
    Route::put('asignar', 'ProyectoController@asignar'); // Asignar Evaluador (Admin)
    Route::put('desasignar', 'ProyectoController@desasignar'); // Desasignar Evaluador (Admin)
    Route::put('evaluacion', 'ProyectoController@evaluacion'); // Enviar proyecto para evaluacion (Estudiante)
    Route::put('activar', 'ProyectoController@activar'); // Activar Proyecto (Evaluador)
    Route::put('completar', 'ProyectoController@completar'); // Completar Pryoecto (Evaluador)
    Route::get('documentacion', 'ProyectoController@documentos'); // Consultar documentos(diagramas) del proyecto
    Route::get('plataforma', 'ProyectoController@plataforma'); // Consulta los Casos de prueba del proyecto
    Route::get('scripts', 'ProyectoController@scripts'); // Consulta el codigo fuente del proyecto
    Route::get('basedatos','ProyectoController@basedatos'); // Consulta el codigo sql del proyecto
    Route::get('total', 'NotaGlobalController@total'); // Consulta la califacion final del proyecto
});





// CRUD Casos de prueba
Route::resource('casoPrueba', 'CasoPruebaController');


// Consulta los tipos de input (Estudiante, Evaluador)
Route::get('tiposInputs', 'TestInputsController@index');
