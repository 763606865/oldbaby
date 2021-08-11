<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('banners', BannerController::class);
    $router->resource('stores', StoreController::class);
    $router->resource('tags', TagController::class);
    $router->resource('platforms', PlatformController::class);
    $router->resource('store_albums', StoreAlbumController::class);
});
