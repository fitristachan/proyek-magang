<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('/auth/index', 'Auth::index');
$routes->post('/auth/index', 'Auth::index');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');
$routes->post('/auth/logout', 'Auth::logout');
 
$routes->get('/auth/addUser', 'Auth::addUser',['filter' => 'authGuard']);
$routes->post('/auth/addUser', 'Auth::addUser',['filter' => 'authGuard']);
$routes->get('/auth/editUser', 'Auth::editUser',['filter' => 'authGuard']);
$routes->post('/auth/editUser', 'Auth::editUser',['filter' => 'authGuard']);
$routes->get('/auth/editUser/(:any)', 'Auth::editUser/$1',['filter' => 'authGuard']);
$routes->post('/auth/editUser/(:any)', 'Auth::editUser/$1',['filter' => 'authGuard']);
$routes->get('/auth/viewUser', 'Auth::viewUser',['filter' => 'authGuard']);
$routes->post('/auth/viewUser', 'Auth::viewUser',['filter' => 'authGuard']);
$routes->get('/auth/saveUser', 'Auth::saveUser',['filter' => 'authGuard']);
$routes->post('/auth/saveUser', 'Auth::saveUser',['filter' => 'authGuard']);
$routes->get('/auth/deleteUser', 'Auth::deleteUser',['filter' => 'authGuard']);
$routes->post('/auth/deleteUser', 'Auth::deleteUser',['filter' => 'authGuard']);
$routes->get('/auth/deleteUser/(:any)', 'Auth::deleteUser/$1',['filter' => 'authGuard']);
$routes->post('/auth/deleteUser/(:any)', 'Auth::deleteUser/$1',['filter' => 'authGuard']);


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
//home
$routes->get('/home/(:any)', 'Home::$1', ['filter' => 'authGuard']);
$routes->post('/home/(:any)', 'Home::$1',['filter' => 'authGuard']);

//print dan history
$routes->get('/generate-pdf', 'SPK::generatePDF',['filter' => 'authGuard']);
$routes->get('/spk/history', 'History::index',['filter' => 'authGuard']);

//spk
$routes->get("/spk", "SPK::index",['filter' => 'authGuard']);
$routes->post('/spk/submit', 'SPK::submit_alternative',['filter' => 'authGuard']);
$routes->get('/nextpage', 'SPK::index',['filter' => 'authGuard']);
$routes->get('/spk/result/(:num)', 'SPK::result/$1',['filter' => 'authGuard']);

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
