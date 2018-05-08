<?php
Route::get('/', 'WikiTextsController@index');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');

# CREATE
# Show the form to add a new text
Route::group(['middleware' => 'auth'], function () {

    Route::get('/texts/create', 'WikiTextsController@create');

    # READ
    Route::post('/texts', 'WikiTextsController@store');

    # UPDATE
    # Show the form to edit a specific text
    Route::get('/texts/{id}/edit', 'WikiTextsController@edit');

    # Process the form to edit a specific text
    Route::put('/texts/{id}', 'WikiTextsController@update');

    # DELETE
    Route::get('/texts/{id}/delete', 'WikiTextsController@delete');

    # Process the deletion of a text
    Route::delete('/texts/{id}', 'WikiTextsController@destroy');

    # Search
    Route::get('/texts/tag/{id}', 'WikiTextsController@tag');

    # Search
    Route::get('/texts/tags', 'WikiTextsController@tags');

});
Route::get('/texts', 'WikiTextsController@index');

# Show an individual text
Route::get('/texts/{id}', 'WikiTextsController@display');

Auth::routes();