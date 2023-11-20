<?php

use FrameworkSimas\Config\JWTAuth;
use FrameworkSimas\Config\Flasher;

function put()
{
    echo '<input type="hidden" name="_method" value="PUT">';
}

function errorValidate($args)
{
    if (isset($_SESSION['errors'][$args])) {
        echo "<div class=\"text-danger\">
        {$_SESSION['errors'][$args]}</div>";
    }
}

function isInvalid($args)
{
    if (isset($_SESSION['errors'][$args])) {
        echo "is-invalid";
    }
}

function oldValue($args)
{
    if (isset($_SESSION['old'][$args])) {
        echo "value=\"{$_SESSION['old'][$args]}\"";
    }
}

function d($args)
{
    var_dump($args);
}

function dd($args)
{
    var_dump($args);
    die;
}

function includeView($dir, $data = [])
{
    extract($data);
    include ROOT . "/resources/views/{$dir}";
}

function auth()
{
    $token = JWTAuth::getToken();
    if (isset($token)) {
        return $token;
    }
}

function flasher()
{
    return Flasher::flash();
}

function successFlash($message)
{
    Flasher::setFlash('SUCCESS', $message, 'success');
}

function failedFlash($message)
{
    Flasher::setFlash('FAILED', $message, 'danger');
}

function lang($key, $variables = [])
{
    $lang = include ROOT .  "/app/Lang/{$_ENV['APP_LANG']}.php";

    if (array_key_exists($key, $lang)) {
        $translation = $lang[$key];
        foreach ($variables as $variableKey => $variableValue) {
            $translation = str_replace(":{$variableKey}", $variableValue, $translation);
        }
        return $translation;
    }

    return $key;
}

function isRoute($routeName)
{
    return isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === $routeName;
}

function jsonResponse($data, $statusCode = 200)
{
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    http_response_code($statusCode);
    echo json_encode($data);
    exit();
}

function redirect($dest)
{
    header("Location: " . BASEURL . "{$dest}");
}

function request($key = null)
{
    $requestData = [];

    if (!empty($_POST)) {
        $requestData += $_POST;
    }

    $jsonPayload = file_get_contents('php://input');
    $jsonDecoded = json_decode($jsonPayload, true);

    if ($jsonDecoded !== null && is_array($jsonDecoded)) {
        $requestData += $jsonDecoded;
    }

    if ($key !== null) {
        return isset($requestData[$key]) ? $requestData[$key] : null;
    }

    return $requestData;
}

function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function isWebRequest()
{
    $path = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    return strpos($path, '/api/') !== 0;
}
