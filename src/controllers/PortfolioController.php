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

        $repo = new PortfolioRepository();
        $portfolio = $repo->findByUser($_SESSION['user']['id']);

        $this->render('portfolio', [
            'portfolio' => $portfolio
        ]);
    }
}