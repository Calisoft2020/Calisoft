<?php

//Consulta el proyecto del estudiante
Route::get('/user/proyectos', 'UserController@proyectos');

//Consulta de estudiantes
Route::prefix('student')->group(function () {
    Route::get('search', 'UserController@searchFreeStudents');
    Route::get('invitations', 'UserController@invitaciones');
});

//Invitaciones de proyecto
Route::resource('invitations', 'InvitationController', [
    'only' => ['store', 'update', 'destroy'],
    'parameters' => [
        'invitations' => 'proyecto',
    ],
]);

// subir documentación(diagramas) de estudiante
Route::resource('documentacion', 'DocumentoController', [
    'only' => ['index', 'store', 'update', 'destroy'],
]);

// Subir codigo fuente
Route::resource('scripts', 'ScriptController', [
    'only' => ['store', 'destroy', 'index']
]);

// Visualizcion del codigo fuente
Route::post('/scripts/preview/{url}', 'ScriptController@preview');

//Visualizacion del codigo sql
Route::post('sql/preview/{url}', 'ArchivoSqlController@preview');

//Consulta las evaluaciones en estudiante
Route::prefix('evaluacion')->group(function () {
    Route::get('modelado', 'EvaluationApiController@modelado'); //Consulta la evaluacion de los diagrmas
});

// ruta de subir el archivo  sql 
Route::resource('sql', 'ArchivoSqlController', [
    'only' => ['index', 'store', 'destroy'],
]);

// El estudiante evian el coso prueba con el formato del formulario
Route::post('enviarCasoPrueba/{casoPrueba}', 'CasoPruebaController@enviarCasoPrueba');
