<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'FilmsController::index', ['as' => 'home.index']);
$routes->get('/register', 'Home::register', ['as' => 'home.register']);
$routes->get('/login', 'Home::login', ['as' => 'home.login']);
$routes->get('/logout', 'Home::logout', ['as' => 'home.logout']);
$routes->get('/upload', 'Home::create', ['as' => 'home.create']);
$routes->get('/schedule/(:segment)', 'Home::schedule/$1', ['as' => 'home.schedule']);

$routes->group('user', function ($routes) {
  $routes->get('', 'UsersController::index');
  $routes->get('me/(:segment)', 'UsersController::me/$1');
  $routes->post('login', 'UsersController::login', ['as' => 'user.login']);
  $routes->post('register', 'UsersController::create', ['as' => 'user.create']);
  $routes->put('update/(:segment)', 'UsersController::update/$1');
  $routes->delete('delete/(:segment)', 'UsersController::delete/$1');
});

$routes->group('film', function ($routes) {
  $routes->get('', 'FilmsController::index');
  $routes->get('(:segment)', 'FilmsController::show/$1');
  $routes->post('create', 'FilmsController::create', ['as' => 'film.create']);
  $routes->put('update/(:segment)', 'FilmsController::update/$1');
  $routes->delete('delete/(:segment)', 'FilmsController::delete/$1');
});

$routes->group('schedule', function ($routes) {
  $routes->get('', 'SchedulesController::index');
  $routes->get('(:segment)', 'SchedulesController::show/$1');
  $routes->post('create', 'SchedulesController::create', ['as' => 'schedule.create']);
  $routes->put('update/(:segment)', 'SchedulesController::update/$1');
  $routes->delete('delete/(:segment)', 'SchedulesController::delete/$1');
  $routes->post('add/(:segment)', 'SchedulesController::add/$1');
});

$routes->group('comment', function ($routes) {
  $routes->get('', 'Comments::index');
  $routes->get('(:segment)', 'Comments::show/$1');
  $routes->post('create', 'Comments::create', ['as' => 'comment.create']);
});

$routes->group('transaction', function ($routes) {
  $routes->get('', 'TransactionsController::index', ['as' => 'transaction.history']);
  $routes->get('(:segment)', 'TransactionsController::show/$1');
  $routes->post('prepare', 'TransactionsController::prepare', ['as' => 'transaction.prepare']);
  $routes->post('payment', 'TransactionsController::payment', ['as' => 'transaction.payment']);
  $routes->put('update/(:segment)', 'TransactionsController::update/$1');
  $routes->delete('delete/(:segment)', 'TransactionsController::delete/$1');
});
