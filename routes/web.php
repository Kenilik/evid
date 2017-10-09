<?php
/*
 * Authentication Routes
 */
Auth::routes();

Route::get('/', 'InvestigationController@index')->name('home');

Route::get('/invs', 'InvestigationController@index');
Route::get('/invs/{investigation}', 'InvestigationController@searchInvItems')->name('searchInvItems');
Route::get('/invs/{investigation}/items', 'ItemController@index')->name('items');

//  AJAX call handlers
Route::post('/updateItemTags', 'ItemController@updateItemTags');
Route::post('/removeItemTag', 'ItemController@removeItemTag');

Route::get('/test', function() {
    return view('test');
}); 


Route::get('/tables', function() {
	return view::make('tables');
}); 

Route::get('/blank', function () {
    return view::make('blank');
});

Route::get('/forms', function() {
	return View::make('form');
});

Route::get('/icons', function () {
    return View::make('icons');
});

Route::get('/charts', function () {
    return View::make('charts');
});

Route::get('/tables', function () {
    return View::make('table');
});

Route::get('/grid', function () {
    return View::make('grid');
});

Route::get('/buttons', function () {
    return View::make('buttons');
});

Route::get('/icons', function () {
    return View::make('icons');
});

Route::get('/panels', function () {
    return View::make('panel');
});

Route::get('/typography', function () {
    return View::make('typography');
});

Route::get('/notifications', function () {
    return View::make('notifications');
});

Route::get('/blank', function () {
    return View::make('blank');
});

Route::get('/documentation', function () {
    return View::make('documentation');
});

Route::get('/stats', function() {
   return View::make('stats');
});

Route::get('/progressbars', function() {
    return View::make('progressbars');
});

Route::get('/collapse', function() {
    return View::make('collapse');
});