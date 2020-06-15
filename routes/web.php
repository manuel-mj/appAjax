<?php

use Illuminate\Support\Facades\Route;

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


// INDEX
Route::get('/', 'CocheController@index')->name('index');

// Peticiones AJAX
Route::get('/ajaxPeticionCoches', 'CocheController@ajaxPeticionCoches')->name('ajaxPeticionCoches');

// Crear
Route::get('/storeCoche', 'CocheController@storeCoche')->name('storeCoche');

// Panel de Editar
Route::get('/editCoche/{id}', 'CocheController@editCoche')->name('editCoche');

// Actualizar
Route::get('/updateCoche/{id}', 'CocheController@updateCoche')->name('updateCoche');

// Eliminar
Route::get('/cocheDelete/{id}', 'CocheController@cocheDelete')->name('cocheDelete');
