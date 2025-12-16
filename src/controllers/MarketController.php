<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/StockRepository.php';


class MarketController extends Controller
{
    public function index()
    {
        $repo = new StockRepository();
        $stocks = $repo->findAll();

        $this->render('market', ['stocks' => $stocks]);
    }
}