<?php

namespace FrameworkSimas\Controller;

use FrameworkSimas\Model\User;
use FrameworkSimas\Config\Flasher;
use FrameworkSimas\Config\JWTAuth;
use FrameworkSimas\Config\Controller;

class AuthController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register()
    {
        if ($this->user->create($_POST) > 0) {
            Flasher::setFlash('BERHASIL', 'Register', 'success');
            header("Location: " . BASEURL . "/login");
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Data incorrect, please try again!']);
            return;
        }
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->user->getUserByEmail($email);

        if (!$user || $user['password'] !== $password) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid credentials']);
            return;
        }

        $token = [
            'sub' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'exp' => time() + 60 * 60 // Token berlaku selama 1 jam
        ];

        JWTAuth::createToken($token, $token['exp']);
        Flasher::setFlash('BERHASIL', 'Login', 'success');
        header("Location: " . BASEURL . "/user");
    }

    public function logout()
    {
        JWTAuth::deleteToken();
        Flasher::setFlash('BERHASIL', 'Logout', 'success');
        header("Location: " . BASEURL . "/login");
        exit;
    }
}
