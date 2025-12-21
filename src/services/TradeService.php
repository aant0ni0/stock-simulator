<?php

require_once __DIR__ . '/../repository/StockRepository.php';
require_once __DIR__ . '/../repository/TransactionRepository.php';
require_once __DIR__ . '/../repository/PortfolioRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';


class TradeService
{
    public function buy(int $userId, int $stockId, int $quantity): void
    {
        $stockRepo = new StockRepository();
        $price = $stockRepo->getPriceById($stockId);

        if ($price === null) {
            throw new Exception('Stock not found');
        }

        $transactionRepo = new TransactionRepository();
        $portfolioRepo = new PortfolioRepository();
        $userRepo = new UserRepository();

        $cash = $userRepo->getCash($userId);
        $totalCost = $price * $quantity;
        if ($cash < $totalCost) {
            throw new RuntimeException('Brak środków');
        }

        $transactionRepo->createBuy($userId, $stockId, $quantity, $price);
        $portfolioRepo->addStock($userId, $stockId, $quantity);
        $userRepo->updateCash($userId, -$totalCost);

    }

    public function sell(int $userId, int $stockId, int $quantity): void
    {
        $stockRepo = new StockRepository();
        $price = $stockRepo->getPriceById($stockId);

        if ($price === null) {
            throw new Exception('Stock not found');
        }

        $portfolioRepo = new PortfolioRepository();
        $currentQuantity = $portfolioRepo->getQuantity($userId, $stockId);

        if ($currentQuantity < $quantity) {
            throw new Exception('Not enough stock to sell');
        }

        $transactionRepo = new TransactionRepository();
        $userRepo = new UserRepository();

        $transactionRepo->createSell($userId, $stockId, $quantity, $price);
        $portfolioRepo->removeStock($userId, $stockId, $quantity);
        $userRepo->updateCash($userId, $price * $quantity);

    }
}