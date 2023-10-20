<?php

namespace FrameworkSimas\Middleware;

use FrameworkSimas\Config\JWTAuth;

class RoleMiddleware
{
    public function handle($auth)
    {
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                header("Location: " . BASEURL . "/login");
                exit();
            } else {
                if ($auth == 'auth') {
                    return true;
                }
                return ($token->role == $auth) ? true : false;
            }
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }
}
