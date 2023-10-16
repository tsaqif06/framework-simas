<?php

namespace FrameworkSimas\Config;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth
{
    private static $SECRET_KEY;

    public static function init()
    {
        self::$SECRET_KEY = $_ENV['JWT_SECRET'];
    }

    public static function createToken($payload, $exp)
    {
        self::init();
        $jwt = JWT::encode($payload, self::$SECRET_KEY, 'HS256');
        setcookie("token", $jwt, $exp, "/");
    }

    public static function deleteToken()
    {
        setcookie("token", "", time() - 3600, "/");
    }

    public static function getToken()
    {
        self::init();
        if (isset($_COOKIE['token'])) {
            $jwt = $_COOKIE['token'];
            try {
                $payload = JWT::decode($jwt, new Key(self::$SECRET_KEY, 'HS256'));
                return $payload;
            } catch (\Exception $e) {
                return $e;
            }
        } else {
            return null;
        }
    }
}