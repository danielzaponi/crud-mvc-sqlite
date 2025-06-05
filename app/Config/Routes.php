<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index',['as' => 'home']);

$routes->get('/users', 'UserController::index',['as' => 'users']);
$routes->post('/users/list', 'UserController::list');
$routes->get('/users/(:num)', 'UserController::show/$1');
$routes->post('/users/create', 'UserController::create');
$routes->delete('/users/delete/(:num)', 'UserController::delete/$1');
$routes->put('/users/update/(:num)', 'UserController::update/$1');

$routes->get('/internacoes', 'InternacoesController::index',['as' => 'internacoes']);
$routes->post('/internacoes/list', 'InternacoesController::list');
$routes->get('/internacoes/(:num)', 'InternacoesController::show/$1');
$routes->post('/internacoes/create', 'InternacoesController::create');
$routes->delete('/internacoes/delete/(:num)', 'InternacoesController::delete/$1');
$routes->put('/internacoes/update/(:num)', 'InternacoesController::update/$1');