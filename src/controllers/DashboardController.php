<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/StockRepository.php';


class DashboardController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $userRepo = new UserRepository();
        $stockRepo = new StockRepository();

        $cash = $userRepo->getCash($_SESSION['user']['id']);
        $stocks = $stockRepo->findAll();

        $this->render('dashboard', [
            'stocks' => $stocks,
            'cash' => $cash
        ]);
    }
}