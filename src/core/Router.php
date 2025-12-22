<?php

require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/DashboardController.php';
require_once __DIR__ . '/../controllers/MarketController.php';
require_once __DIR__ . '/../controllers/TradeController.php';
require_once __DIR__ . '/../controllers/PortfolioController.php';
require_once __DIR__ . '/../controllers/TransactionController.php';
require_once __DIR__ . '/../controllers/LeaderboardController.php';
require_once __DIR__ . '/../controllers/AssetController.php';



class Router {
    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        switch ($path) {
            case '/':
                $controller = new HomeController();
                $controller->index();
                break;

            case '/login':
                $controller = new AuthController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->login();
                } else {
                    $controller->loginForm();
                }
                break;

            case '/dashboard':
                $controller = new DashboardController();
                $controller->index();
                break;

            case '/register':
                $controller = new AuthController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->register();
                } else {
                    $controller->registerForm();
                }
                break;

            case '/market':
                $controller = new MarketController();
                $controller->index();
                break;


            case '/buy':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller = new TradeController();
                    $controller->buy();
                }
                break;


            case '/sell':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new TradeController())->sell();
                }
                break;

            case '/portfolio':
                (new PortfolioController())->index();
                break;

            case '/transactions':
                (new TransactionController())->index();
                break;

            case '/leaderboard':
                (new LeaderboardController())->index();
                break;

            case '/asset':
                (new AssetController())->show();
                break;


            default:
                http_response_code(404);
                echo "404 NOT FOUND";
        }
    }
}
