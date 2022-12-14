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
$routes->setDefaultController('App\controllers\Admin\Admin');
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
// $routes->group("/", ["namespace" => "App\Controllers\Admin", "filter" => "auth:admin"], function($routes){
$routes->group("/", ["namespace" => "App\Controllers\Home", "filter" => "auth:user,admin,master"], function ($routes) {
    $routes->get("", "Dashboard::index", ["as" => "home"]);
});



$routes->group("libros", ["namespace" => "App\Controllers\Book", "filter" => "auth:user,admin,master"], function ($routes) {
    $routes->get("", "Books::index", ["as" => "books"]);
    $routes->get("agregar", "Books::create", ["as" => "books_create"]);
    $routes->post("agregar/guardar", "Books::store", ["as" => "books_store"]);

    $routes->get("editar/(:any)", "Books::edit/$1", ["as" => "books_edit"]);
    $routes->post("editar/actualizar", "Books::update", ["as" => "books_update"]);

    $routes->get("eliminar/(:any)", "Books::delete/$1", ["as" => "books_delete"]);


    // ----- Autors -----

    $routes->get("autores", "Autors::index", ["as" => "autors"]);
    $routes->get("autores/agregar", "Autors::create", ["as" => "autors_create"]);
    $routes->post("autores/guardar", "Autors::store", ["as" => "autors_store"]);

    $routes->get("autores/editar/(:any)", "Autors::edit/$1", ["as" => "autors_edit"]);
    $routes->post("autores/actualizar", "Autors::update", ["as" => "autors_update"]);

    $routes->get("autores/eliminar/(:num)", "Autors::delete/$1", ["as" => "autors_delete"]);




    // ----- Editorials -----

    $routes->get("editoriales", "Editorials::index", ["as" => "editorials"]);
    $routes->get("editoriales/agregar", "Editorials::create", ["as" => "editorials_create"]);
    $routes->post("editoriales/guardar", "Editorials::store", ["as" => "editorials_store"]);
    $routes->post("editoriales/buscar", "Editorials::getEditorialByName", ["as" => "getEditorialByName"]);

    $routes->get("editoriales/editar/(:any)", "Editorials::edit/$1", ["as" => "editorials_edit"]);
    $routes->post("editoriales/actualizar", "Editorials::update", ["as" => "editorials_update"]);

    $routes->get("editoriales/eliminar/(:num)", "Editorials::delete/$1", ["as" => "editorials_delete"]);
});

$routes->group("auth", ["namespace" => "App\Controllers\Auth"], function ($routes) {
    // $routes->get("registro", "Register::index", ["as" => "register"]);
    // $routes->post("store", "Register::store");
    $routes->get("login", "Login::index", ["as" => "login"]);
    $routes->post("check", "Login::signin", ["as" => "signin"]);
    $routes->get("logout", "Login::signout", ["as" => "signout"]);
});

$routes->group("usuarios", ["namespace" => "App\Controllers", "filter" => "auth:master"], function ($routes) {
    $routes->get("", "Users::index", ["as" => "users"]);
    $routes->get("agregar", "Users::create", ["as" => "users_create"]);
    $routes->post("agregar/guardar", "Users::store", ["as" => "users_store"]);

    $routes->get("editar/(:any)", "Users::edit/$1", ["as" => "users_edit"]);
    $routes->post("actualizar", "Users::update", ["as" => "users_update"]);

    $routes->get("eliminar/(:num)", "Users::delete/$1", ["as" => "users_delete"]);
});



$routes->group("estudiantes", ["namespace" => "App\Controllers", "filter" => "auth:user,admin,master"], function ($routes) {
    // $routes->get("registro", "Register::index", ["as" => "register"]);
    // $routes->post("store", "Register::store");
    $routes->get("", "Students::index", ["as" => "students"]);
    $routes->get("agregar", "Students::create", ["as" => "students_create"]);
    $routes->post("agregar/guardar", "Students::store", ["as" => "students_store"]);

    $routes->get("editar/(:any)", "Students::edit/$1", ["as" => "students_edit"]);
    $routes->post("actualizar", "Students::update", ["as" => "students_update"]);

    $routes->get("eliminar/(:num)", "Students::delete/$1", ["as" => "students_delete"]);
});



$routes->group("prestamos", ["namespace" => "App\Controllers\Lend", "filter" => "auth:user,admin,master"], function ($routes) {

    $routes->get("", "Lend::index", ["as" => "lend"]);
    $routes->get("agregar", "Lend::create", ["as" => "lend_create"]);
    $routes->post("agregar/guardar", "Lend::store", ["as" => "lend_store"]);

    $routes->get("editar/(:any)", "Lend::edit/$1", ["as" => "lend_edit"]);
    $routes->post("actualizar", "Lend::update", ["as" => "lend_update"]);

    $routes->get("eliminar/(:num)/(:num)", "Lend::delete/$1/$2", ["as" => "lend_delete"]);
});


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
