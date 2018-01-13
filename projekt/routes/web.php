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

//zobrazenie profilu
Route::get('/profil', 'profilController@show');

Route::get('/miestnost/udaje-o-skupine', function () {
    return view('udaje-o-skupine');
});
Route::get('/cas/udaje-o-skupine', function () {
    return view('udaje-o-skupine');
});

//riadenie skupiny
Route::get('/sprava-skupin', 'GroupManagementController@show');

//registracia clenov adminom
Route::get('/profil/vytvor-skupinu', 'RegisterGroupController@show');

//registracia skupiny adminom
Route::get('/profil/vytvor-clena', 'RegisterMemberController@show');

