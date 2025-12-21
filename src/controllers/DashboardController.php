<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/UserRepository.php';


class DashboardController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $userRepo = new UserRepository();
        $cash = $userRepo->getCash($_SESSION['user']['id']);

        $this->render('dashboard', [
            'cash' => $cash
        ]);
    }
}