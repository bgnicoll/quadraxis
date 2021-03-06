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

Route::get('/', 'HomeController@index');

Route::get('projects', 'ProjectsController@index');

Route::get('project/create', 'ProjectsController@create');

Route::post('project/store', 'ProjectsController@store');

Route::post('project/{name}/webhook', 'ProjectsController@webhook');

Route::get('project/{name}', 'ProjectsController@show');

