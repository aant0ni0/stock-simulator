<?php

require_once __DIR__ . '/../core/Database.php';


class StockRepository
{
    public function findAll(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT * FROM stocks order by symbol');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAssetById(int $stockId): ?array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'SELECT * FROM stocks WHERE id = :id'
        );
        $stmt->execute(['id' => $stockId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPriceById(int $stockId): ?float
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'SELECT price FROM stocks WHERE id = :id'
        );
        $stmt->execute(['id' => $stockId]);

        $price = $stmt->fetchColumn();

        return $price !== false ? (float)$price : null;
    }

    public function get24hChange(int $stockId): float
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'SELECT price
         FROM stock_price_history
         WHERE stock_id = :id
           AND created_at <= NOW() - INTERVAL \'24 hours\'
         ORDER BY created_at DESC
         LIMIT 1'
        );
        $stmt->execute(['id' => $stockId]);
        $price24h = $stmt->fetchColumn();

        if ($price24h === false) {
            $stmt = $pdo->prepare(
                'SELECT price
             FROM stock_price_history
             WHERE stock_id = :id
             ORDER BY created_at ASC
             LIMIT 1'
            );
            $stmt->execute(['id' => $stockId]);
            $price24h = $stmt->fetchColumn();
        }

        if ($price24h === false) {
            return 0.0;
        }

        $stmt = $pdo->prepare('SELECT price FROM stocks WHERE id = :id');
        $stmt->execute(['id' => $stockId]);
        $currentPrice = (float)$stmt->fetchColumn();

        if ((float)$price24h == 0.0) {
            return 0.0;
        }

        return (($currentPrice - (float)$price24h) / (float)$price24h) * 100;
    }



}