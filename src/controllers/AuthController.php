<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../core/Flash.php';



class AuthController extends Controller
{
    public function loginForm()
    {
        $this->render('login');

    }

    public function registerForm(): void
    {
        $this->render('register');
    }

    public function register(): void
    {
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            Flash::add('error', 'All fields are required.');
            header('Location: /register', true, 303);
            exit;
        }

        $repo = new UserRepository();

        if ($repo->findByEmail($email)) {
            Flash::add('error', 'User with this email already exists.');
            header('Location: /register', true, 303);
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $repo->create($email, $passwordHash);

        Flash::add('success', 'Account created. You can log in now.');
        header('Location: /login', true, 303);
        exit;
    }



    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $repo = new UserRepository();
        $user = $repo->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            Flash::add('error', 'Invalid email or password.');
            header('Location: /login', true, 303);
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
        ];

        Flash::add('success', 'Logged in successfully.');
        header('Location: /dashboard', true, 303);
        exit;
    }

    public function logout(): void
    {
        session_start();
        session_unset();

        $_SESSION['flash'][] = [
            'type' => 'info',
            'message' => 'You have been logged out.'
        ];

        session_write_close();

        header('Location: /login', true, 303);
        exit;
    }


}