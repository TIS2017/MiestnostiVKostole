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


Auth::routes();

//uvodna stranka
Route::get('/', 'HomeController@index')->name('home');

//prihlasenie pouzivatela
Route::get('/prihlasenie', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/prihlasenie', 'Auth\LoginController@login');

//registracia pouzivatela
Route::get('/registracia', 'Auth\RegisterController@showRegistrationForm');
Route::post('/registracia', 'Auth\RegisterController@register');



//filtracia podla miestnosti
Route::get('/miestnost', function () {
    return view('miestnost');
});

//filtracia podla casu
Route::get('/cas', function () {
    return view('cas');
});

//filtracia podla skupiny
Route::get('/skupina', function () {
    return view('skupina');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/miestnost/udaje-o-skupine', function () {
    return view('udaje-o-skupine');
});
