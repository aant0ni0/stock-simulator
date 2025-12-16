<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';


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
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            echo "All fields are required";
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $repo = new UserRepository();

        if ($repo->findByEmail($email)) {
            echo "User with this email already exists";
            return;
        }

        $repo->create($email, $passwordHash);

        header('Location: /login');
        exit;
    }



    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $repo = new UserRepository();
        $user = $repo->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->render('login', ['error' => 'Invalid credentials']);
            return;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
        ];

        header('Location: /dashboard');
        exit;
    }

    public function logout()
    {
        session_destroy();

        header('Location: /login');
        exit;
    }

}