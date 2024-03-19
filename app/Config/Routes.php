<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Obtener todos los clientes
$routes->get('/clientes', 'ClienteController::listado');

// Borrar
$routes->delete('/clientes/delete/(:num)', 'ClienteController::delete/$1');

// Crear
$routes->get('/clientes/nuevo', 'ClienteController::crear');

$routes->post('clientes/guardar', 'ClienteController::guardar');

// Editar
$routes->get('clientes/editar/(:num)', 'ClienteController::editar/$1');
$routes->post('clientes/actualizar/(:num)', 'ClienteController::actualizar/$1');


$routes->get('/clientes/buscar', 'ClienteController::buscar');