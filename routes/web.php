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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Transaction ID control functions
Route::get('/showRegistrationFormTranKey', 'RegisterController@showRegistrationFormTranKey')->name('showRegistrationFormTranKey');
Route::get('/handleMoneySendRequest/{tranKey}', 'TransactionHandleController@handleMoneySendRequest')->name('handleMoneySendRequest');

Route::group(['middleware' => ['auth']], function () {
//    These Routes needs user to be logged in
    require ('page.php');
    require ('operation.php');
});
