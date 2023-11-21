<?php

use FrameworkSimas\Config\API;
use FrameworkSimas\Controller\AuthController;
use FrameworkSimas\Controller\UserController;
use FrameworkSimas\Controller\ProductController;

/**
 * User
 */
/**
 * show
 */
API::add('GET', '/user', UserController::class, 'index', 'auth');
API::add('GET', '/user/{id}', UserController::class, 'find', 'auth');

/**
 * create
 */
API::add('POST', '/user/create', UserController::class, 'store', 'admin');

/**
 * edit
 */
API::add('POST', '/user/edit/{id}', UserController::class, 'upate', 'admin');

/**
 * delete
 */
API::add('GET', '/user/delete/{id}', UserController::class, 'delete', 'admin');





/**
 * Product
 */
/**
 * show
 */
API::add('GET', '/product', ProductController::class, 'index', 'auth');
API::add('GET', '/product/{id}', ProductController::class, 'find', 'auth');

/**
 * create
 */
API::add('POST', '/product/create', ProductController::class, 'store');

/**
 * edit
 */
API::add('POST', '/product/edit/{id}', ProductController::class, 'upate', 'admin');

/**
 * delete
 */
API::add('GET', '/product/delete/{id}', ProductController::class, 'delete', 'admin');





/**
 * Authorization
 */
API::add('POST', '/register', AuthController::class, 'register');

API::add('POST', '/login', AuthController::class, 'login');

API::run();
