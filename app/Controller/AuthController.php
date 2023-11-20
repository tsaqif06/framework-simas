<?php

namespace FrameworkSimas\Controller;

use FrameworkSimas\Model\User;
use Rakit\Validation\Validator;
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
        $validator = new Validator;
        $validation = $validator->make(request(), [
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required|min:5'
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->firstOfAll();
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = request();

            if ($this->isWebRequest()) {
                redirect("/register");
            }

            return jsonResponse(['error' => 'Validation failed', 'errors' => $errors], 400);
        }

        if ($this->user->create(request()) > 0) {
            successFlash('Registering your account');

            if ($this->isWebRequest()) {
                redirect("/login");
            }

            return jsonResponse(['message' => 'Account registered successfully'], 201);
        } else {
            failedFlash('Registering your account');

            if ($this->isWebRequest()) {
                redirect("/register");
            }

            return jsonResponse(['error' => 'Account registration failed'], 500);
        }
    }

    public function login()
    {
        if ($this->isWebRequest()) {
            $validator = new Validator;
            $validation = $validator->make(request(), [
                'email'    => 'required',
                'password' => 'required'
            ]);

            $validation->validate();

            if ($validation->fails()) {
                $errors = $validation->errors()->firstOfAll();
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = request();

                return redirect("/login");
            }
        } else {
            if (!isset(request()['email']) || !isset(request()['password'])) {
                return jsonResponse(['error' => 'Validation failed', 'errors' => "Wrong credential"], 400);
            }
        }

        $email = request()['email'];
        $password = request()['password'];

        $user = $this->user->getUserByEmail($email);

        if (!$user || $user['password'] !== $password) {
            if ($this->isWebRequest()) {
                failedFlash('Email or password incorrect');
                return redirect("/register");
            } else {
                return jsonResponse(['error' => 'Email or password incorrect'], 401);
            }
        }

        $token = [
            'sub'   => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email'],
            'role'  => $user['role'],
            'exp'   => time() + 60 * 60 // Token berlaku selama 1 jam
        ];

        JWTAuth::createToken($token, $token['exp']);
        successFlash('Login');

        if ($this->isWebRequest()) {
            return redirect("/user");
        } else {
            return jsonResponse(['message' => 'Login successful', 'token' => $_COOKIE['token']]);
        }
    }


    public function logout()
    {
        JWTAuth::deleteToken();
        successFlash('Logout');

        if ($this->isWebRequest()) {
            redirect("/login");
        }

        return jsonResponse(['message' => 'Logout successful']);
    }

    private function isWebRequest()
    {
        $path = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        return strpos($path, '/api/') !== 0;
    }
}
