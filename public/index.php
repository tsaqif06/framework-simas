<?php
session_start();

use Dotenv\Dotenv;
use FrameworkSimas\Config\Flasher;

require_once __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

require_once __DIR__ . "/../app/Config/Bootstrap.php";
require_once __DIR__ . "/../app/Config/Functions.php";
define("BASEURL", $_ENV['BASE_URL']);
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
$flasher = Flasher::flash();
$GLOBALS['flasher'] = $flasher;

require_once __DIR__ . '/../routes/route.php';
