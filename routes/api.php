<?php

use FrameworkSimas\Config\Route;
use FrameworkSimas\Controller\AuthController;
use FrameworkSimas\Controller\UserController;
use FrameworkSimas\Controller\LoginController;
use FrameworkSimas\Controller\ProductController;
use FrameworkSimas\Controller\RegisterController;


/**
 * User
 */
/**
 * show
 */
Route::add('GET', '/user', UserController::class, 'index', 'auth');

/**
 * create
 */
Route::add('GET', '/user/create', UserController::class, 'create', 'admin');
Route::add('POST', '/user/create', UserController::class, 'store', 'admin');

/**
 * edit
 */
Route::add('GET', '/user/edit/{id}', UserController::class, 'edit', 'admin');
Route::add('POST', '/user/edit/{id}', UserController::class, 'update', 'admin');

/**
 * delete
 */
Route::add('GET', '/user/delete/{id}', UserController::class, 'delete', 'admin');





/**
 * Product
 */
/**
 * show
 */
Route::add('GET', '/product', ProductController::class, 'index', 'auth');

/**
 * create
 */
Route::add('GET', '/product/create', ProductController::class, 'create');
Route::add('POST', '/product/create', ProductController::class, 'store');

/**
 * edit
 */
Route::add('GET', '/product/edit/{id}', ProductController::class, 'edit', 'admin');
Route::add('POST', '/product/edit/{id}', ProductController::class, 'update', 'admin');

/**
 * delete
 */
Route::add('GET', '/product/delete/{id}', ProductController::class, 'delete', 'admin');





/**
 * Authorization
 */
Route::add('POST', '/register', AuthController::class, 'register');

Route::add('POST', '/api/login', AuthController::class, 'login');