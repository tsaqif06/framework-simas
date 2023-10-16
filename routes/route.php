<?php

use FrameworkSimas\Config\Route;
use FrameworkSimas\Controller\AuthController;
use FrameworkSimas\Controller\UserController;
use FrameworkSimas\Controller\LoginController;
use FrameworkSimas\Controller\MigrateController;
use FrameworkSimas\Controller\RegisterController;

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

Route::add('GET', '/runmigrate', MigrateController::class, 'index');

Route::add('GET', '/register', RegisterController::class, 'index');
Route::add('POST', '/register', AuthController::class, 'register');

Route::add('GET', '/login', LoginController::class, 'index');
Route::add('POST', '/login', AuthController::class, 'login');

Route::add('POST', '/logout', AuthController::class, 'logout');

Route::run();
