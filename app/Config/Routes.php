<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(
    function () {
        return view('errors/error-404');
    }
);
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
$routes->get('/', 'Home::index');

$routes->get('login', 'Users::login');
$routes->get('dashboard', 'Home::dashboard');

$routes->get('reset-password', 'Users::resetPassword');
$routes->get('sign-up', 'Users::signUp');
$routes->get('sign-in', 'Users::login');

$routes->post('sign-in', 'Users::login');
$routes->get('sign-out', 'Users::logout');
$routes->get('logout', 'Users::logout');
$routes->get('users-list', 'Users::index');
$routes->get('add-user', 'Users::add');
$routes->post('add-user', 'Users::add');
$routes->get('edit-user/(:segment)', 'Users::edit/$1');
$routes->post('edit-user/(:segment)', 'Users::edit/$1');
$routes->get('delete-user/(:segment)', 'Users::delete/$1');


$routes->get('user-profile', 'Users::profile');
$routes->get('profile', 'Users::profile');
$routes->post('update-user', 'Users::update');

/*
 * Catégories Routes
 */
$routes->get('categories-list', 'Categories::index');
$routes->get('add-category', 'Categories::add');
$routes->post('add-category', 'Categories::add');
$routes->get('edit-category/(:segment)', 'Categories::edit/$1');
$routes->post('edit-category/(:segment)', 'Categories::edit/$1');
$routes->get('delete-category/(:segment)', 'Categories::delete/$1');

/*
 * SMIG Routes
 */
$routes->get('smigs-list', 'Smigs::index');
$routes->get('add-smig', 'Smigs::add');
$routes->post('add-smig', 'Smigs::add');
$routes->get('edit-smig/(:segment)', 'Smigs::edit/$1');
$routes->post('edit-smig/(:segment)', 'Smigs::edit/$1');
$routes->get('delete-smig/(:segment)', 'Smigs::delete/$1');

/*
 * Employees Routes
 */

$routes->get('employees-list', 'Employees::index');
$routes->get('add-employee', 'Employees::add');
$routes->post('add-employee', 'Employees::add');
$routes->get('edit-employee/(:segment)', 'Employees::edit/$1');
$routes->post('edit-employee/(:segment)', 'Employees::edit/$1');
$routes->get('delete-employee/(:segment)', 'Employees::delete/$1');
$routes->get('service-card-employee/(:segment)', 'Employees::serviceCard/$1');
$routes->get('add-employee-image/(:segment)', 'Employees::addImage/$1');
$routes->post('add-employee-image/(:segment)', 'Employees::addImage/$1');
$routes->get('export-employees', 'Employees::export');


//Ajx
$routes->get('fetch-employees', 'Employees::fetchEmployees');
$routes->post('fetch-employees', 'Employees::fetchEmployees');
$routes->get('add-appointment', 'Pointages::tailly');
$routes->get('point-employee/(:segment)', 'Pointages::point/$1');
$routes->post('fetch-taillies', 'Pointages::fetchTaillies');
$routes->get('appointments-list', 'Pointages::index');
$routes->get('cancel-tailly/(:segment)', 'Pointages::cancel/$1');

/*
 * Payment routes
 */

$routes->get('new-payment', 'Payments::index');
$routes->get('presences-list/(:segment)', 'Payments::presenceList/$1');
$routes->post('presences-list/(:segment)', 'Payments::presenceList/$1');
$routes->post('invoice-card-employee/(:segment)', 'Payments::invoice/$1');
$routes->get('invoice-card-employee/(:segment)', 'Payments::invoice/$1');

$routes->get('payment-elements/(:segment)', 'Payments::elements/$1');
$routes->get('general-payment-elements', 'Payments::elementForGeneralPayment');
$routes->post('save-salary-elements/(:segment)', 'Payments::saveSalary/$1');

$routes->post('payments-listing', 'Payments::paymentListing');
$routes->get('payments-listing', 'Payments::paymentListing');


/*
 * Transport Taux routes
 */
$routes->get('add-taux', 'TauxTransports::add');
$routes->post('add-taux', 'TauxTransports::add');
$routes->get('taux-list', 'TauxTransports::index');
$routes->get('edit-taux/(:segment)', 'TauxTransports::update/$1');
$routes->post('update-taux/(:segment)', 'TauxTransports::update/$1');
$routes->get('active-taux/(:segment)', 'TauxTransports::active/$1');


/*
 *
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
