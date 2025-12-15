<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';

class HomeController extends Controller
{
    public function index()
    {
        $this->render('home');
        $pdo = Database::getConnection();

        $stmt = $pdo->query('SELECT COUNT(*) FROM users');
        $count = $stmt->fetchColumn();

        echo "Users in DB: " . $count;
    }
}