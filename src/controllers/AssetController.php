<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/StockRepository.php';
require_once __DIR__ . '/../repository/PriceHistoryRepository.php';

class AssetController extends Controller
{
    public function show(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $stockId = (int)($_GET['id'] ?? 0);
        if ($stockId <= 0) {
            echo 'Invalid asset';
            return;
        }

        $stockRepo = new StockRepository();
        $priceRepo = new PriceHistoryRepository();

        $asset = $stockRepo->getAssetById($stockId);
        $change24h = $stockRepo->get24hChange($stockId);
        $history = $priceRepo->getLast30Days($stockId);

        $this->render('asset', [
            'page' => 'asset',
            'asset' => $asset,
            'history' => $history,
            'change24h' => $change24h
        ]);
    }
}