<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('clientes', static function ($routes) {
    $routes->get('/', 'ClienteController::listado'); // Obtener todos los clientes
    $routes->delete('delete/(:num)', 'ClienteController::delete/$1');// Borrar
    $routes->get('nuevo', 'ClienteController::crear');// Crear
    $routes->post('guardar', 'ClienteController::guardar');
    $routes->get('editar/(:num)', 'ClienteController::editar/$1');// Editar
    $routes->post('actualizar/(:num)', 'ClienteController::actualizar/$1');
    $routes->get('buscar', 'ClienteController::buscar');
});

$routes->group('dispositivos', static function ($routes) {
    $routes->get('/', 'DispositivoController::listado');
    $routes->get('nuevo', 'DispositivoController::crear');
    $routes->get('obtenerClientes', 'DispositivoController::obtenerClientes');
    $routes->get('obtenerNombreClientePorCedula', 'DispositivoController::obtenerNombreClientePorCedula');
    $routes->post('guardar', 'DispositivoController::registrarDispositivo');
});

$routes->group('ordenes', static function ($routes) {
    $routes->get('/', 'OrdenController::listado');
    $routes->get('nueva', 'OrdenController::crear');
    $routes->post('buscarDispositivos', 'OrdenController::buscarDispositivos');
    $routes->post('guardarOrden', 'OrdenController::guardarOrden');
});