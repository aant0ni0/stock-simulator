<?php


require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/PortfolioRepository.php';

class PortfolioController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $portfolioRepo = new PortfolioRepository();
        $userRepo = new UserRepository();

        $holdings = $portfolioRepo->getUserHoldingsWithStats($userId);
        $cash = $userRepo->getCash($userId);

        $holdingsValue = 0;
        foreach ($holdings as $h) {
            $holdingsValue += $h['quantity'] * $h['current_price'];
        }

        $totalValue = $cash + $holdingsValue;
        $startCash = 10000;
        $totalPnL = $totalValue - $startCash;

        $this->render('portfolio', [
            'page' => 'portfolio',
            'holdings' => $holdings,
            'cash' => $cash,
            'holdingsValue' => $holdingsValue,
            'totalValue' => $totalValue,
            'totalPnL' => $totalPnL
        ]);
    }

}