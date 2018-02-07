<?php

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

Route::get('/', 'HomeController@index');

Route::get('pdf', 'pdfController@invoice');

Route::get('error', function()
{
    return view('errores.error');    
});


Route::group(['middleware' => 'auth'], function() {
       
	Route::get('centros', 'Maestros\CentrosController@getIndex');

	Route::get('centros/show/{id}','Maestros\CentrosController@getShow');

	Route::get('centros/create', 'Maestros\CentrosController@getCreate');

	Route::get('centros/edit/{id}', 'Maestros\CentrosController@getEdit');

	Route::post('centros/create','Maestros\CentrosController@postCreate');

	Route::post('centros/edit/{id}','Maestros\CentrosController@postUpdate');

	Route::post('centros/delete/{id}','Maestros\CentrosController@postDelete');




	Route::get('personal', 'Maestros\PersonalController@getIndex');
	Route::get('personal2', 'Maestros\PersonalController@getIndex2');

	Route::get('personal/show/{id}','Maestros\PersonalController@getShow');

	Route::get('personal/create', 'Maestros\PersonalController@getCreate');

	Route::get('personal/edit/{id}', 'Maestros\PersonalController@getEdit');

	Route::post('personal/create','Maestros\PersonalController@postCreate');

	Route::post('personal/edit/{id}','Maestros\PersonalController@postUpdate');

	Route::post('personal/delete/{id}','Maestros\PersonalController@postDelete');


	Route::get('turnos', 'Maestros\TurnosController@getIndex');
	
	Route::get('turnos/show/{id}','Maestros\TurnosController@getShow');

	Route::get('turnos/create', 'Maestros\TurnosController@getCreate');

	Route::get('turnos/edit/{id}', 'Maestros\TurnosController@getEdit');

	Route::post('turnos/create','Maestros\TurnosController@postCreate');

	Route::post('turnos/edit/{id}','Maestros\TurnosController@postUpdate');

	Route::post('turnos/delete/{id}','Maestros\TurnosController@postDelete');


	Route::get('dias', 'Maestros\CalendariolaboralController@getIndex');
	
	Route::get('dias/show/{id}','Maestros\CalendariolaboralController@getShow');

	Route::get('dias/create', 'Maestros\CalendariolaboralController@getCreate');

	Route::get('dias/edit/{id}', 'Maestros\CalendariolaboralController@getEdit');

	Route::post('dias/create','Maestros\CalendariolaboralController@postCreate');

	Route::post('dias/edit/{id}','Maestros\CalendariolaboralController@postUpdate');

	Route::post('dias/delete/{id}','Maestros\CalendariolaboralController@postDelete');


	Route::get('categorias', 'Maestros\CategoriasController@getIndex');
	
	Route::get('categorias/show/{id}','Maestros\CategoriasController@getShow');

	Route::get('categorias/create', 'Maestros\CategoriasController@getCreate');

	Route::get('categorias/edit/{id}', 'Maestros\CategoriasController@getEdit');

	Route::post('categorias/create','Maestros\CategoriasController@postCreate');

	Route::post('categorias/edit/{id}','Maestros\CategoriasController@postUpdate');

	Route::post('categorias/delete/{id}','Maestros\CategoriasController@postDelete');


	Route::get('tipoincidencias', 'Maestros\TipoincidenciasController@getIndex');
	
	Route::get('tipoincidencias/show/{id}','Maestros\TipoincidenciasController@getShow');

	Route::get('tipoincidencias/create', 'Maestros\TipoincidenciasController@getCreate');

	Route::get('tipoincidencias/edit/{id}', 'Maestros\TipoincidenciasController@getEdit');

	Route::post('tipoincidencias/create','Maestros\TipoincidenciasController@postCreate');

	Route::post('tipoincidencias/edit/{id}','Maestros\TipoincidenciasController@postUpdate');

	Route::post('tipoincidencias/delete/{id}','Maestros\TipoincidenciasController@postDelete');



	Route::get('niveles', 'Maestros\NivelesController@getIndex');
	
	Route::get('niveles/show/{id}','Maestros\NivelesController@getShow');

	Route::get('niveles/create', 'Maestros\NivelesController@getCreate');

	Route::get('niveles/edit/{id}', 'Maestros\NivelesController@getEdit');

	Route::post('niveles/create','Maestros\NivelesController@postCreate');

	Route::post('niveles/edit/{id}','Maestros\NivelesController@postUpdate');

	Route::post('niveles/delete/{id}','Maestros\NivelesController@postDelete');



	Route::get('equipos', 'Maestros\EquiposController@getIndex');
	
	Route::get('equipos/show/{id}','Maestros\EquiposController@getShow');

	Route::get('equipos/create', 'Maestros\EquiposController@getCreate');

	Route::get('equipos/edit/{id}', 'Maestros\EquiposController@getEdit');

	Route::post('equipos/create','Maestros\EquiposController@postCreate');

	Route::post('equipos/edit/{id}','Maestros\EquiposController@postUpdate');

	Route::post('equipos/delete/{id}','Maestros\EquiposController@postDelete');







	Route::get('chamanes', 'Relacionados\ChamanesController@getIndex');

	Route::get('chamanes/edit/{id}', 'Relacionados\ChamanesController@getEdit');
	
	Route::post('chamanes/edit/{id}','Relacionados\ChamanesController@postUpdate');

	Route::get('chamanes/create', 'Relacionados\ChamanesController@getInsertar');

	Route::post('chamanes/insertar','Relacionados\ChamanesController@postInsertar');

	Route::post('chamanes/delete/{id}','Relacionados\ChamanesController@postDelete');




	Route::get('clave', 'Relacionados\ClaveController@getIndex');
	
	Route::get('clave/subir/{id}','Relacionados\ClaveController@getSubir');

	Route::get('clave/bajar/{id}','Relacionados\ClaveController@getBajar');

	Route::get('clave/insertar/{id}', 'Relacionados\ClaveController@getInsertar');

	Route::post('clave/insertar/{id}','Relacionados\ClaveController@postInsertar');

	Route::post('clave/delete/{id}','Relacionados\ClaveController@postDelete');



	Route::get('puntos', 'Relacionados\PuntosController@getIndex');

	Route::get('puntos/subir/{id}','Relacionados\PuntosController@getSubir');

	Route::get('puntos/bajar/{id}','Relacionados\PuntosController@getBajar');

	Route::get('puntos/create/{id}', 'Relacionados\PuntosController@getInsertar');

	Route::post('puntos/insertar/{id}','Relacionados\PuntosController@postInsertar');

	Route::post('puntos/delete/{id}','Relacionados\PuntosController@postDelete');



	Route::get('compoequipos', 'Relacionados\CompoequiposController@getIndex');

	Route::get('compoequipos/edit/{id}', 'Relacionados\CompoequiposController@getEdit');
	
	Route::post('compoequipos/edit/{id}','Relacionados\CompoequiposController@postUpdate');

	Route::get('compoequipos/create', 'Relacionados\CompoequiposController@getInsertar');

	Route::post('compoequipos/insertar','Relacionados\CompoequiposController@postInsertar');

	Route::post('compoequipos/delete/{id}','Relacionados\CompoequiposController@postDelete');


	Route::get('externos', 'Relacionados\ExternosController@getIndex');

	Route::get('externos/edit/{id}', 'Relacionados\ExternosController@getEdit');
	
	Route::post('externos/edit/{id}','Relacionados\ExternosController@postUpdate');

	Route::get('externos/create', 'Relacionados\ExternosController@getInsertar');

	Route::post('externos/insertar','Relacionados\ExternosController@postInsertar');

	Route::post('externos/delete/{id}','Relacionados\ExternosController@postDelete');



	Route::get('puntos_detalle', 'Relacionados\PuntosdetalleController@getIndex');

	Route::get('puntos_detalle/edit/{id}', 'Relacionados\PuntosdetalleController@getEdit');
	
	Route::post('puntos_detalle/edit/{id}','Relacionados\PuntosdetalleController@postUpdate');

	Route::get('puntos_detalle/create', 'Relacionados\PuntosdetalleController@getInsertar');

	Route::post('puntos_detalle/insertar','Relacionados\PuntosdetalleController@postInsertar');

	Route::post('puntos_detalle/delete/{id}','Relacionados\PuntosdetalleController@postDelete');


	Route::get('incidencias', 'Movimientos\IncidenciasController@getIndex');

	Route::get('incidencias/edit/{id}', 'Movimientos\IncidenciasController@getEdit');
	
	Route::post('incidencias/edit/{id}','Movimientos\IncidenciasController@postUpdate');

	Route::get('incidencias/create', 'Movimientos\IncidenciasController@getInsertar');

	Route::post('incidencias/insertar','Movimientos\IncidenciasController@postInsertar');

	Route::post('incidencias/delete/{id}','Movimientos\IncidenciasController@postDelete');


	Route::get('sustituciones', 'Movimientos\SustitucionesController@getIndex');

	Route::get('sustituciones/edit/{id}', 'Movimientos\SustitucionesController@getEdit');
	
	Route::post('sustituciones/edit/{id}','Movimientos\SustitucionesController@postUpdate');

	Route::get('sustituciones/create', 'Movimientos\SustitucionesController@getInsertar');

	Route::post('sustituciones/insertar','Movimientos\SustitucionesController@postInsertar');

	Route::post('sustituciones/delete/{id}','Movimientos\SustitucionesController@postDelete');



	Route::get('bosquejos/edita', 'Bosquejos\BosquejoController@getIndex2');

	

	Route::get('bosquejos/edit/{id}', 'Bosquejos\BosquejoController@getEdit');
	
	Route::post('bosquejos/edit/{id}','Bosquejos\BosquejoController@postUpdate');

	Route::get('bosquejos/create', 'Bosquejos\BosquejoController@getInsertar');

	Route::post('bosquejos/insertar','Bosquejos\BosquejoController@postInsertar');

	Route::post('bosquejos/delete/{id}','Bosquejos\BosquejoController@postDelete');

	Route::post('bosquejos/bloqueo/{fecha}','Bosquejos\BosquejoController@postBloqueo');

	Route::get('bosquejos/{fecha}', 'Bosquejos\BosquejoController@getIndex');



	Route::get('calcular', 'Bosquejos\CalculoController@getForm');
	Route::get('calcula', 'Bosquejos\CalculoController@getCalculo');
	Route::get('presenta', 'Bosquejos\CalculoController@getPresenta');
	


});

Route::get('muestra', 'Bosquejos\CalculoController@getMuestra');
// Route::get('formulario', 'StorageController@index');
// Route::post('storage/create', 'StorageController@save');



 Route::get('auth/login', function () {
   return view('auth.login');
 });



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
