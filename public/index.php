<?php
session_start();

use Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

require_once __DIR__ . "/../app/Config/Bootstrap.php";
require_once __DIR__ . "/../app/Config/Functions.php";
define("BASEURL", $_ENV['BASE_URL']);
define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/../");

require_once __DIR__ . '/../routes/api.php';
require_once __DIR__ . '/../routes/web.php';
