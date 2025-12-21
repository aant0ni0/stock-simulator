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

    public function findByUser(int $userId): array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'SELECT 
            t.type,
            s.symbol,
            t.quantity,
            t.price,
            t.created_at
         FROM transactions t
         JOIN stocks s ON s.id = t.stock_id
         WHERE t.user_id = :u
         ORDER BY t.created_at DESC'
        );

        $stmt->execute(['u' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}