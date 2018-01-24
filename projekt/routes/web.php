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
Route::get('/miestnost', 'FilterController@loadrooms');
Route::get('/miestnost/filter', 'FilterController@filterRoom');
Route::post('/miestnost', 'FilterController@loadrooms');
Route::post('/miestnost/filter', 'FilterController@filterRoom');

//filtracia podla casu
Route::get('/cas', 'FilterController@showTime');
Route::post('/cas', 'FilterController@showTime');
Route::post('/cas/filter', 'FilterController@filterTime');
Route::get('/cas/filter', 'FilterController@showTime');

//filtracia podla skupiny
Route::post('/skupina', 'FilterController@loadgroups');
Route::post('/skupina/filter', 'FilterController@filterGroup');
Route::get('/skupina', 'FilterController@loadgroups');
Route::get('/skupina/filter', 'FilterController@filterGroup');

//zobrazenie profilu
Route::get('/profil', 'profilController@show');

//udaje o skupine
Route::get('/udaje-o-skupine/{groupname}', 'InfoController@showGroupInfo');
Route::post('/udaje-o-skupine/{groupname}', 'InfoController@addNotification');
Route::get('/udaje-o-skupine/', 'InfoController@show');
Route::post('/udaje-o-skupine/{groupname}/{request}', 'InfoController@confirmRequest');
Route::delete('/udaje-o-skupine/{groupname}/{request}', 'InfoController@deleteRequest');

//riadenie skupiny
Route::get('/sprava-skupin', 'GroupManagementController@show');

//registracia clenov adminom
Route::get('/profil/vytvor-skupinu', 'RegisterGroupController@show');
Route::post('/profil/vytvor-skupinu', 'RegisterGroupController@add');

//registracia skupiny adminom
Route::get('/profil/vytvor-clena', 'RegisterMemberController@show');
Route::post('/profil/vytvor-clena', 'RegisterMemberController@add');

