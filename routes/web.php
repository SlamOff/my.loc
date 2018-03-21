<?php

//Site///////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/', 'SiteController@index');
Route::get('{section}/set/{id}', 'SiteController@cymbals')->where('id', '[0-9]+')->where('section','re');
Route::get('{section}/{collection}/set/{id}', 'SiteController@cymbals')->where('section','(nu|my|re)')->where('id', '[0-9]+');
//Route::get('/{section}/{page?}','SiteController@catalog')->where('section', '(nu|my|re)')->where('page', '[0-9]+');
Route::get('/{section}/{collection?}/{page?}','SiteController@catalog')->where('section', '(nu|my|re)')->name('catalog');
Route::get('/cart', 'SiteController@cart');

Route::get('/who', 'SiteController@who');
Route::get('/how', 'SiteController@how');


//Route::get('/test', 'SiteController@test');
//Rest///////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/cymbals/get', 'RestController@getCymbals');
Route::get('/buy/cymbals/{id}', 'SiteController@buy');
Route::get('/buy_abort/cymbals/{id}', 'SiteController@buyAbort');
Route::get('/buy_abort_all/cymbals/{id}', 'SiteController@buyAbortAll');
Route::post('/order', 'SiteController@order');
