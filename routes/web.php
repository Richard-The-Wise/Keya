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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix'     => 'webapi',
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::get('obtenerPaises', 'PaisesCrudController@obtenerPaises');
    Route::get('obtenerEstados', 'EstadoCrudController@obtenerEstados');
    Route::get('obtenerEstadosDirecciones', 'EstadoCrudController@obtenerEstadosDirecciones');
    Route::get('obtenerMunicipios', 'MunicipioCrudController@obtenerMunicipios');
    Route::get('obtenerMunicipiosDirecciones', 'MunicipioCrudController@obtenerMunicipiosDirecciones');
});
