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

$routes->get('/planmakan', 'CPlanMakan::index');
$routes->get('/planmakan/mingguan', 'CPlanMakan::mingguan');
$routes->post('/planmakan/tambah', 'CPlanMakan::tambah');
$routes->get('/planmakan/hapus/(:num)/(:num)', 'CPlanMakan::hapus/$1/$2');
$routes->get('/planmakan', 'CPlanMakan::mingguan');
$routes->get('/planmakan/bulanan', 'CPlanMakan::bulanan');
$routes->get('/planminum', 'CPlanMinum::index');
$routes->post('/planminum/add', 'CPlanMinum::add');
$routes->post('/planminum/reset', 'CPlanMinum::reset');
$routes->post('/planminum/target', 'CPlanMinum::target');





$routes->get('/logout', 'CAuth::logout');
$routes->get('/login', 'CAuth::index');
$routes->post('/login/ceklogin', 'CAuth::ceklogin');

$routes->get('/register', 'CAuth::register');
$routes->post('/register/prosesregister', 'CAuth::prosesregister');

$routes->post('/login/ceklogin', 'Login::ceklogin');


