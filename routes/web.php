<?php

use Illuminate\Support\Facades\Route;
// use Session;
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


Route::resource('/', App\Http\Controllers\Web\WebController::class);
Route::resource('/cms', App\Http\Controllers\Cms\MainController::class);
Route::any('/web', [App\Http\Controllers\Web\WebController::class,'webdev']);
Route::get('/getsession', function(){
	return Session::all();
});


/* CMS ROUTE###############################################################*/
// Route Setup
Route::resource('company', App\Http\Controllers\Cms\Setup\CompanyController::class);
Route::any('company/{id}', [App\Http\Controllers\Cms\Setup\CompanyController::class, 'update']);
Route::resource('role', App\Http\Controllers\Cms\Setup\RoleController::class);
Route::resource('rolemenu', App\Http\Controllers\Cms\Setup\RolemenuController::class);
Route::resource('menu', App\Http\Controllers\Cms\Setup\MenuController::class);
Route::resource('user', App\Http\Controllers\Cms\Setup\UserController::class);
Route::resource('usercomp', App\Http\Controllers\Cms\Setup\UsercompController::class);
Route::resource('gantipass', App\Http\Controllers\Cms\Setup\GantipassController::class);
Route::any('dashboard', [App\Http\Controllers\Cms\MainController::class,'dashboard']);
//Route Master
Route::resource('docs', App\Http\Controllers\Cms\Master\DocsController::class);
// Route Autocomplete
Route::resource('comboparent', App\Http\Controllers\Cms\Combo\Master\ComboparentController::class);
Route::resource('comborole', App\Http\Controllers\Cms\Combo\Master\ComboroleController::class);



/* WEB ROUTE###############################################################*/
Route::any('/login', [App\Http\Controllers\Web\WebController::class,'login']);
Route::any('/register', [App\Http\Controllers\Web\WebController::class,'register']);

