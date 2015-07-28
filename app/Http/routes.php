<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::resource(
    'quote',
    'QuoteController',
    ['only' => ['store', 'index', 'show']]
);

Route::get('/', function() {
    return view('index');
});

Route::get(
    '/app/{param1?}/{param2?}/{param3?}',
    function() {
        return view('app');
    }
);