<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/admin/dashboard', 'CAdmin::index');

$routes->get('/usermanage', 'CUserManage::index');
$routes->post('/usermanage/tambahData', 'CUserManage::tambahData');
$routes->post('/usermanage/hapus/(:num)', 'CUserManage::deleteData/$1');
$routes->post('/usermanage/edit/(:num)', 'CUserManage::editData/$1');
$routes->get('/editprofile', 'CUserProfile::index');  
$routes->post('/editprofile/update/(:num)', 'CUserProfile::update/$1');



$routes->get('/logout', 'CAuth::logout');
$routes->get('/login', 'CAuth::index');
$routes->post('/login/ceklogin', 'CAuth::ceklogin');

$routes->get('/register', 'CAuth::register');
$routes->post('/register/prosesregister', 'CAuth::prosesregister');

$routes->post('/login/ceklogin', 'Login::ceklogin');


