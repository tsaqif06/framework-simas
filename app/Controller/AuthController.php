<?php

namespace FrameworkSimas\Controller;

use FrameworkSimas\Model\User;
use Rakit\Validation\Validator;
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

            if (!isWebRequest()) {
                return jsonResponse(['error' => 'Validation failed', 'errors' => $errors], 400);
            }

            redirect("/register");
        }

        $newUser = [
            "name" => request('name'),
            "email" => request('email'),
            "password" => hashPassword(request('password')),
        ];

        if ($this->user->create($newUser) > 0) {
            if (!isWebRequest()) {
                return jsonResponse(['message' => 'Account registered successfully'], 201);
            }

            successFlash('Registering your account');
            redirect("/login");
        } else {
            if (!isWebRequest()) {
                return jsonResponse(['error' => 'Account registration failed'], 500);
            }

            failedFlash('Registering your account');
            redirect("/register");
        }
    }

    public function login()
    {
        $validator = new Validator;
        $validation = $validator->make(request(), [
            'email'    => 'required',
            'password' => 'required'
        ]);

        $validation->validate();

        $email = request('email');
        $password = request('password');

        if ($validation->fails()) {
            $errors = $validation->errors()->firstOfAll();
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = request();

            if (!isWebRequest()) {
                if (!isset($email) || !isset($password)) {
                    return jsonResponse(['error' => 'Validation failed', 'errors' => "Wrong credential"], 400);
                }
            }

            return redirect("/login");
        }

        $user = $this->user->find('email', $email);

        if (!$user || !password_verify($password, $user['password'])) {
            if (!isWebRequest()) {
                return jsonResponse(['error' => 'Email or password incorrect'], 401);
            }

            failedFlash('Email or password incorrect');
            return redirect("/register");
        }

        $token = [
            'sub'   => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email'],
            'role'  => $user['role'],
            'exp'   => time() + 60 * 60
        ];

        JWTAuth::createToken($token, $token['exp']);

        if (!isWebRequest()) {
            return jsonResponse(['message' => 'Login successful', 'token' => $_COOKIE['token']]);
        }

        successFlash('Login');
        return redirect("/user");
    }


    public function logout()
    {
        JWTAuth::deleteToken();

        if (!isWebRequest()) {
            return jsonResponse(['message' => 'Logout successful']);
        }

        successFlash('Logout');
        redirect("/login");
    }
}
