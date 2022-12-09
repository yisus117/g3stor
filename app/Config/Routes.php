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
$routes->group("/", ["namespace" => "App\Controllers\Home"], function ($routes) {
    $routes->get("", "Dashboard::index", ["as" => "home"]);
});



$routes->group("libros", ["namespace" => "App\Controllers\Book"], function ($routes) {
    $routes->get("", "Books::index", ["as" => "books"]);


    $routes->get("agregar", "Books::create", ["as" => "book_create"]);
    $routes->post("agregar/guardar", "Books::store", ["as" => "book_store"]);

    $routes->get("editar/(:any)", "Books::edit/$1", ["as" => "book_edit"]);
    $routes->post("editar/actualizar", "Books::update", ["as" => "book_update"]);

    $routes->get("eliminar/(:any)", "Books::delete/$1", ["as" => "book_delete"]);


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



    // ----- Categories -----

    // $routes->get("categorias", "Categories::index", ["as" => "categories"]);
    // $routes->get("categorias/crear", "Categories::create", ["as" => "categories_create"]);
    // $routes->post("categorias/guardar", "Categories::store", ["as" => "categories_store"]);

    // $routes->get("categorias/editar/(:any)", "Categories::edit/$1", ["as" => "categories_edit"]);
    // $routes->post("categorias/actualizar", "Categories::update", ["as" => "categories_update"]);

    // $routes->get("categorias/eliminar/(:any)", "Categories::delete/$1", ["as" => "categories_delete"]);
});

$routes->group("auth", ["namespace" => "App\Controllers\Auth"], function ($routes) {
    // $routes->get("registro", "Register::index", ["as" => "register"]);
    // $routes->post("store", "Register::store");
    $routes->get("login", "Login::index", ["as" => "login"]);
    $routes->post("check", "Login::signin", ["as" => "signin"]);
    $routes->get("logout", "Login::signout", ["as" => "signout"]);
});


$routes->group("estudiantes", ["namespace" => "App\Controllers"], function ($routes) {
    // $routes->get("registro", "Register::index", ["as" => "register"]);
    // $routes->post("store", "Register::store");
    $routes->get("", "Students::index", ["as" => "students"]);
    $routes->get("agregar", "Students::create", ["as" => "students_create"]);
    $routes->post("agregar/guardar", "Students::store", ["as" => "students_store"]);

    $routes->get("editar/(:any)", "Students::edit/$1", ["as" => "students_edit"]);
    $routes->post("actualizar", "Students::update", ["as" => "students_update"]);

    $routes->get("eliminar/(:num)", "Students::delete/$1", ["as" => "students_delete"]);
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
