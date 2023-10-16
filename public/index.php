<?php

use Dotenv\Dotenv;
use FrameworkSimas\Config\Route;
use FrameworkSimas\Config\Flasher;
use FrameworkSimas\Controller\AuthController;
use FrameworkSimas\Controller\UserController;
use FrameworkSimas\Controller\LoginController;
use FrameworkSimas\Controller\RegisterController;


require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/Config/Functions.php";
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();
define("BASEURL", $_ENV['BASE_URL']);
$flasher = Flasher::flash();
$GLOBALS['flasher'] = $flasher;
/**
 * show
 */
Route::add('GET', '/user', UserController::class, 'index', 'user');

/**
 * create
 */
Route::add('GET', '/user/create', UserController::class, 'create');
Route::add('POST', '/user/create', UserController::class, 'store');

/**
 * edit
 */
Route::add('GET', '/user/edit/{id}', UserController::class, 'edit');
Route::add('POST', '/user/edit/{id}', UserController::class, 'update');

/**
 * delete
 */
Route::add('GET', '/user/delete/{id}', UserController::class, 'delete');

Route::add('GET', '/register', RegisterController::class, 'index');
Route::add('POST', '/register', AuthController::class, 'register');

Route::add('GET', '/login', LoginController::class, 'index');
Route::add('POST', '/login', AuthController::class, 'login');

Route::add('POST', '/logout', AuthController::class, 'logout');

Route::run();
