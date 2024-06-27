<?php
session_start();

use Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Validate CSRF token on POST request

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cek apakah input _csrf ada dalam $_POST
    if (!isset($_POST['_csrf'])) {
        // Jika tidak ada, beri pesan error kustom
        die('The page has expired due to inactivity. Please refresh and try again.');
    }

    // Ambil token yang dikirimkan oleh pengguna
    $submittedToken = $_POST['_csrf'];

    // Ambil token CSRF dari session
    $storedToken = $_SESSION['csrf_token'] ?? '';

    // Validasi token yang dikirimkan dengan token yang disimpan di session
    if (!hash_equals($storedToken, $submittedToken)) {
        // Jika token tidak valid, beri pesan error kustom
        die('Invalid CSRF token. Please refresh the page and try again.');
    }
}



require_once __DIR__ . "/../app/Config/Bootstrap.php";
require_once __DIR__ . "/../app/Config/Functions.php";
define("BASEURL", $_ENV['BASE_URL']);
define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/../");

require_once __DIR__ . '/../routes/api.php';
require_once __DIR__ . '/../routes/web.php';
