<?php

Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('signup', 'AuthController@signup');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//Return List Countries
Route::get('countries', 'CountryController@index');

// Return single Country
Route::get('country/{id}', 'CountryController@show');

//Create new Country
Route::post('countries', 'CountryController@store');

//Update a country
Route::put('countries/{id}', 'CountryController@update');

//Delete Country
Route::delete('countries/{id}', 'CountryController@destroy');

//Return user activities
Route::get('activities', 'ActivityController@index');