<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../core/Flash.php';



class AuthController extends Controller
{
    public function loginForm()
    {
        $this->render('login', [], 'auth');
    }

    public function registerForm(): void
    {
        $this->render('register', ['page' => 'register'], 'auth');
    }

    public function register(): void
    {
        $email     = trim($_POST['email'] ?? '');
        $password1 = trim($_POST['password1'] ?? '');
        $password2 = trim($_POST['password2'] ?? '');
        $name      = trim($_POST['firstname'] ?? '');
        $surname   = trim($_POST['lastname'] ?? '');

        if ($email === '' || $password1 === '' || $password2 === '' || $name === '' || $surname === '') {
            Flash::add('error', 'All fields are required.');
            header('Location: /register', true, 303);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flash::add('error', 'Invalid email address.');
            header('Location: /register', true, 303);
            exit;
        }

        if ($password1 !== $password2) {
            Flash::add('error', 'Passwords do not match.');
            header('Location: /register', true, 303);
            exit;
        }

        if (strlen($password1) < 6) {
            Flash::add('error', 'Password must be at least 6 characters.');
            header('Location: /register', true, 303);
            exit;
        }

        $repo = new UserRepository();

        if ($repo->findByEmail($email)) {
            Flash::add('error', 'User with this email already exists.');
            header('Location: /register', true, 303);
            exit;
        }

        $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

        $repo->create($email, $passwordHash, $name, $surname);

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