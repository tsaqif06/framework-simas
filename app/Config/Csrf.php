<?php
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['_csrf'])) {
        die('The page has expired due to inactivity. Please refresh and try again.');
    }

    $submittedToken = $_POST['_csrf'];
    $storedToken = $_SESSION['csrf_token'] ?? '';

    if (!hash_equals($storedToken, $submittedToken)) {
        die('Invalid CSRF token. Please refresh the page and try again.');
    }
}
