<?php
require_once __DIR__ . '/../core/Database.php';

class PriceHistoryRepository
{
    public function getLast30Days(int $stockId): array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'SELECT price, created_at
             FROM price_history
             WHERE stock_id = :id
             ORDER BY created_at ASC
             LIMIT 30'
        );

        $stmt->execute(['id' => $stockId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

