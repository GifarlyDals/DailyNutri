<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/logout', 'Login::logout');
$routes->get('/login', 'CAuth::index');
$routes->get('/register', 'CAuth::register');
$routes->post('/register/prosesregister', 'CAuth::prosesregister');

$routes->post('/login/ceklogin', 'Login::ceklogin');


