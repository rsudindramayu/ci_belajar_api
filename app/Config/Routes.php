<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->group('api/v1', ['namespace' => 'App\Controllers\API\v1'], static function ($routes) {
    $routes->get('products', 'ProductController::getAllProduct');
    $routes->get('products/(:num)', 'ProductController::findProduct/$1');
    $routes->post('products', 'ProductController::createProduct');
    $routes->put('products/(:num)', 'ProductController::updateProduct/$1');
    $routes->delete('products/(:num)', 'ProductController::deleteProduct/$1');
});
