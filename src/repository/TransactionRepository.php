<?php


require_once __DIR__ . '/../core/Database.php';

class TransactionRepository
{
    public function createBuy(
        int $userId,
        int $stockId,
        int $quantity,
        float $price
    ): void {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'INSERT INTO transactions (user_id, stock_id, type, quantity, price)
             VALUES (:u, :s, :t, :q, :p)'
        );

        $stmt->execute([
            'u' => $userId,
            's' => $stockId,
            't' => 'BUY',
            'q' => $quantity,
            'p' => $price
        ]);
    }

    public function createSell(
        int $userId,
        int $stockId,
        int $quantity,
        float $price
    ): void {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'INSERT INTO transactions (user_id, stock_id, type, quantity, price)
         VALUES (:u, :s, :t, :q, :p)'
        );

        $stmt->execute([
            'u' => $userId,
            's' => $stockId,
            't' => 'SELL',
            'q' => $quantity,
            'p' => $price
        ]);
    }

}