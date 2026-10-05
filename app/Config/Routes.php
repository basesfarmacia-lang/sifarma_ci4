<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Redireccionar la raíz al login
$routes->get('/', 'Auth::login');

// Rutas Públicas (Login / Logout)
$routes->get('login', 'Auth::login');
$routes->post('login/procesar', 'Auth::procesarLogin');
$routes->get('logout', 'Auth::logout');

// Rutas Protegidas (Requieren inicio de sesión)
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Dashboard (Paso 4)
    $routes->get('dashboard', 'Dashboard::index');
    
    // Gestión de Usuarios
    $routes->get('usuarios', 'Usuarios::index');
    $routes->post('usuarios/crear', 'Usuarios::crear');
    $routes->post('usuarios/cambiar-estado', 'Usuarios::cambiarEstado');
    $routes->post('usuarios/eliminar', 'Usuarios::eliminar');
    
});