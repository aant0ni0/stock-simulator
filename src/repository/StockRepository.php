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
            'SELECT symbol, name, price FROM stocks WHERE id = :id'
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


}