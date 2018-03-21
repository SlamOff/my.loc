<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    //$router->get('/collections/{id}/edit/create', 'CymbalsController@create');
    //$router->post('/collections/{id}/edit/create', 'CymbalsController@store');

    //$router->resource('/{my}/collections/', NuCollectionController::class);
    $router->get('my/collections', 'MyCollectionController@index');
    $router->get('my/collections/create', 'MyCollectionController@create');
    $router->get('my/collections/{id}/edit', 'MyCollectionController@edit');
    $router->post('my/collections/', 'MyCollectionController@store');
    $router->any('my/collections/{collections}', 'MyCollectionController@update');
    $router->delete('my/collections/{collections}', 'MyCollectionController@destroy');

    $router->get('nu/collections', 'NuCollectionController@index');
    $router->get('nu/collections/create', 'NuCollectionController@create');
    $router->get('nu/collections/{id}/edit', 'NuCollectionController@edit');
    $router->post('nu/collections/', 'NuCollectionController@store');
    $router->any('nu/collections/{collections}', 'NuCollectionController@update');
    $router->delete('nu/collections/{collections}', 'NuCollectionController@destroy');


    $router->any('/re/collections/welcome/{id}', 'OptionController@update_re');


    $router->get('re/collections', 'ReCollectionController@index');
    $router->get('re/collections/create', 'ReCollectionController@create');
    $router->get('re/collections/{id}/edit', 'ReCollectionController@edit');
    $router->post('re/collections/', 'ReCollectionController@store');
    $router->any('re/collections/{collections}', 'ReCollectionController@update');
    $router->delete('re/collections/{collections}', 'ReCollectionController@destroy');

    $router->get('{type}/collections/{collection_id}/edit/{id}/edit', 'CymbalsController@edit');
    $router->get('{type}/collections/{collection_id}/edit/create', 'CymbalsController@create');
    $router->post('{type}/collections/{collection_id}/edit', 'CymbalsController@store');
    $router->any('{type}/collections/{collection_id}/edit/{edit}', 'CymbalsController@update');
    $router->delete('{type}/collections/{collection_id}/edit/{edit}', 'CymbalsController@destroy');

    $router->resource('{type}/collections/{collection_id}/edit/{id}/edit', 'PlateController', ['except' => ['index']]);

    $router->resource('orders', OrderController::class);
    $router->resource('pages', PageController::class);
    $router->resource('options', OptionController::class);



});
