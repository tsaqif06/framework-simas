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
                if (!isWebRequest()) {
                    return jsonResponse(['success' => 'false', 'message' => 'Unauthorized'], 401);
                }

                return redirect("/login");
            } else {
                if ($auth == 'auth') {
                    return true;
                }
                return ($token->role == $auth) ? true : false;
            }
        } catch (\Exception $e) {
            return jsonResponse(['error' => $e->getMessage()], 401);
        }
    }
}
