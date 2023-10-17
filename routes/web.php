<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\UserModelController;
use Illuminate\Support\Facades\Route;

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

Route::get(
    '/',
    [CityController::class, 'showCities']
)->name('show.cities');

Route::get(
    '/create/city',
    [CityController::class, 'createCity']
)->name('create.city');

Route::post(
    '/store/city',
    [CityController::class, 'storeCity']
)->name('store.city');

Route::get(
    '/edit/{id}/city',
    [CityController::class, 'editCity']
)->name('edit.city');

Route::post('/store/edit/city',
    [CityController::class, 'storeEditCity']
)->name('store.edit.city');

Route::post(
    '/delete/{id}/city',
    [CityController::class, 'deleteCity']
)->name('delete.city');

Route::get(
    '/users',
    [UserModelController::class, 'showUsers']
)->name('show.users');

Route::get(
    '/create/user',
    [UserModelController::class, 'createUser']
)->name('create.user');

Route::post(
    '/store/user',
    [UserModelController::class, 'storeUser']
)->name('store.user');

Route::post(
    '/delete/{id}/user',
    [UserModelController::class, 'deleteUser']
)->name('delete.user');
