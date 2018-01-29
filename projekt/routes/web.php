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


//udaje o skupine
Route::get('/udaje-o-skupine/{groupname}', 'InfoController@showGroupInfo');
Route::post('/udaje-o-skupine/{groupname}', 'InfoController@addNotification');
Route::get('/udaje-o-skupine/', 'InfoController@showError');
Route::get('/udaje-o-skupine/{groupname}/{request}', 'InfoController@showError');
Route::post('/udaje-o-skupine/{groupname}/{request}', 'InfoController@confirmRequest');
Route::delete('/udaje-o-skupine/{groupname}/{request}', 'InfoController@deleteRequest');

//riadenie skupiny
Route::get('/sprava-skupin/{groupname}', 'GroupManagementController@show');
Route::get('/sprava-skupin/{groupname}/member', 'GroupManagementController@showError');
Route::post('/sprava-skupin/{groupname}', 'GroupManagementController@addRoom');
Route::post('/sprava-skupin/{groupname}/member', 'GroupManagementController@addMember');
Route::get('/sprava-skupin/{groupname}/{request}', 'GroupManagementController@showError');
Route::post('/sprava-skupin/{groupname}/{request}', 'GroupManagementController@confirmRequest');
Route::delete('/sprava-skupin/{groupname}/{request}', 'GroupManagementController@deleteRequest');

//zobrazenie profilu
Route::get('/profil', 'profilController@show');
Route::get('/profil/{groupname}/delete', 'profilController@showError');
Route::delete('/profil/{groupname}/delete', 'profilController@deleteGroup');

//uprava udajov pouzivatela
Route::get('/profil/uprava', 'profilController@showForm');
Route::get('/profil/uprava/edit', 'profilController@showError');
Route::post('/profil/uprava/edit', 'profilController@updateData');
Route::post('/profil/uprava', 'profilController@updatePassword');

//registracia clenov adminom
Route::get('/profil/vytvor-skupinu', 'RegisterGroupController@show');
Route::post('/profil/vytvor-skupinu', 'RegisterGroupController@add');

//registracia skupiny adminom
Route::get('/profil/vytvor-clena', 'RegisterMemberController@show');
Route::post('/profil/vytvor-clena', 'RegisterMemberController@add');


