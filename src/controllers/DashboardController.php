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

        foreach ($stocks as &$stock) {
            $stock['change_24h'] = $stockRepo->get24hChange($stock['id']);
        }
        unset($stock);

        $this->render('dashboard', [
            'stocks' => $stocks,
            'cash' => $cash
        ]);
    }


}