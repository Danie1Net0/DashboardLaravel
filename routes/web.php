<?php

use Illuminate\Support\Facades\Auth;
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

/**
 * Rotas de autenticação e cadastro.
 */
Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', fn() => redirect()->route('login'));

/**
 * Rota do dashboard.
 */
Route::get('/home', 'Dashboard\DashboardController@index')->name('home');

/**
 * Rotas de atualização de dados pessoais e senha.
 */
Route::namespace('Dashboard\Users')->prefix('/dados-pessoais')->group(function () {
    /* Atualização de dados pessoais */
    Route::get('/perfil', 'ProfileController@editProfile')->name('profile.edit');
    Route::put('/perfil/{id}', 'ProfileController@updateProfile')->name('profile.update');

    /* Atualização de senha */
    Route::get('/senha', 'ProfileController@editPassword')->name('password.edit');
    Route::put('/senha/{id}', 'ProfileController@updatePassword')->name('password.update');
});
