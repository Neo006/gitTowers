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


Route::get('/', 'TowerController@index')->name('home');
Route::post('store', 'TowerController@store')->name('tower.store');
Route::get('search', 'TowerController@searchTower')->name('tower.search');
Route::get('editDestroy', 'TowerController@showEditDestroy')->name('tower.editDestroy');
Route::get('destroy/{id}', 'TowerController@destroy')->name('tower.destroy');
Route::get('edit/{id}', 'TowerController@edit')->name('tower.edit');
Route::post('update', 'TowerController@update')->name('tower.update');