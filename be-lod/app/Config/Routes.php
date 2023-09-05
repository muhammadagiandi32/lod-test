<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('api', ['namespace' => '\App\Controllers'], static function ($routes) {
    $routes->get('article/getAll', 'ArticleController::getAll');
    $routes->get('article/show/(:any)', 'ArticleController::show/$1');
    // $routes->resource('ArticleController');
    $routes->get('article', 'ArticleController::index');
    $routes->post('article/new', 'ArticleController::new', ['filter' => 'auth']);
    $routes->get('article/(:num)/edit', 'ArticleController::edit/$1', ['filter' => 'auth']);
    $routes->delete('article/delete/(:num)', 'ArticleController::delete/$1', ['filter' => 'auth']);

    $routes->put('article/update/(:num)', 'ArticleController::update/$1', ['filter' => 'auth']);
    $routes->post('auth', 'AuthController::login');
});
