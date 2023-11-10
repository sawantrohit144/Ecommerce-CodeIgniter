<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Admin
$routes->get('login', 'AdminUser::login');
$routes->post('login', 'AdminUser::login');
$routes->get('dashboard', 'Dashboard::dash');

//categories
$routes->get('categories', 'Dashboard::categories');
$routes->get('addcategories', 'Dashboard::addcategories');
$routes->get('deletecategory', 'Dashboard::deletecategory');
$routes->get('updatecategory', 'Dashboard::updatecategory');

//product
$routes->get('product', 'Dashboard::product');
$routes->get('addproduct', 'Dashboard::addproduct');
$routes->get('deleteproduct', 'Dashboard::deleteproduct');
$routes->get('updateproduct', 'Dashboard::updateproduct');

$routes->get('contactus', 'Dashboard::contactus');
$routes->get('users', 'Dashboard::users');
$routes->get('deleteuser', 'Dashboard::deleteuser');
$routes->get('logout', 'AdminUser::logout');

//Customer
$routes->get('login', 'CustomerUser::login');
$routes->get('login', 'CustomerUser::registration');
$routes->get('logout', 'CustomerUser::logout');

//Customer - Categories
$routes->get('categories', 'CustomerDash::categories');
$routes->get('productbycategory', 'CustomerDash::productbycategory');
$routes->get('productdetail/(:num)', 'CustomerDash::productdetail/$1');
$routes->get('contactus', 'CustomerDash::contactus');

$routes->get('customerdash/addtocart/(:num)/(:num)', 'CustomerDash::addtocart/$1/$2');
$routes->get('customerdash/updateproduct/(:num)/(:num)', 'CustomerDash::updateproduct/$1/$2');
$routes->get('customerdash/checkout', 'CustomerDash::checkout');
$routes->get('cart', 'CustomerDash::cart');
$routes->get('customerdash/thankyou', 'CustomerDash::thankyou');
$routes->get('customerdash/order', 'CustomerDash::order');
$routes->get('customerdash/orderdetail/(:num)', 'CustomerDash::orderdetail/$1');
$routes->get('customerdash/checkout', 'CustomerDash::login');
$routes->get('customerdash/search', 'CustomerDash::search');
