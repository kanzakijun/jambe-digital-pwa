<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'role:user, admin']);
$routes->get('/dashboard/index', 'DashboardController::index', ['filter' => 'role:user']);
$routes->get('/dashboard/pesanan/(:segment)', 'DashboardController::pesanan/$1', ['filter' => 'role:user']);
$routes->post('/pesan', 'DashboardController::pesan');
$routes->get('/auth/login', 'AuthController::index');
$routes->get('/auth/register', 'AuthController::register');
$routes->get('/admin', 'AdminController::index', ['filter' => 'role:admin']);
$routes->get('/admin', 'AdminController::index', ['filter' => 'role:designer']);
$routes->get('/admin/index', 'AdminController::index', ['filter' => 'role:admin']);
//$routes->get('/admin/index', 'AdminController::index', ['filter' => 'role:designer']);

$routes->get('/designer', 'DesignerController::index', ['filter' => 'role:designer']);
$routes->get('/designer/index', 'DesignerController::index', ['filter' => 'role:designer']);
$routes->post('/designer/approval/(:segment)', 'DesignerController::approval/$1', ['filter' => 'role:designer']);

$routes->get('/bayar/(:segment)', 'DashboardController::bayar/$1', ['filter' => 'role:admin,designer,user']);

//$routes->group('product', ['namespace' => 'App\Controllers'], function (RouteCollection $routes) {
$routes->get('/product', 'ProductController::index');
$routes->get('/product/addProduct', 'ProductController::addProduct');
$routes->post('/product/saveProduct', 'ProductController::saveProduct');
$routes->get('/product/editProduct/(:segment)', 'ProductController::editProduct/$1');
$routes->post('/product/updateProduct/(:segment)', 'ProductController::updateProduct/$1');
$routes->get('/product/deleteProduct/(:segment)', 'ProductController::deleteProduct/$1');
$routes->get('/product/detailProduct/(:segment)', 'Home::detailProduct/$1');
$routes->get('/home/detailProduct/(:segment)', 'Home::detail');
//});

$routes->get('/payment', 'PaymentController::index');
$routes->get('/payment/success/(:segment)', 'PaymentController::success/$1');
