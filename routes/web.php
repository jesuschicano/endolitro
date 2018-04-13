<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


/** PARTICIPANTES **/
Route::resource('participantes', 'ParticipanteController');
// Activar o desactivar participantes
Route::get('participantes/actdes/{id}', 'ParticipanteController@actdes');

/** CONCURSOS **/
Route::resource('concursos', 'ConcursoController');
// Historial de concursos
Route::get('historial', 'ConcursoController@historial');
// Agregar puntos a los participantes
Route::get('concursos/{concurso_id}/{participante_id}/{puntuacion}', 'ConcursoController@addPoints');
// Cierre de concurso
Route::post('concursos/{concurso_id}/cierre', 'ConcursoController@cerrar');
// Descarga de PDF
Route::get('concursos/{concurso_id}/imprime', 'ConcursoController@print');
