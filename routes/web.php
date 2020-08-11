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
});
//Notify Route
Route::get('/notify', 'BuyEventController@notify');
Route::get('send', 'NotifyController@index');
Route::get('mail', function () {
    $client = \App\Client::find(1);
    $shopping=\App\Shopping::find(1);
    $client->notify(new \App\Notifications\BuyEvent($shopping));
});

