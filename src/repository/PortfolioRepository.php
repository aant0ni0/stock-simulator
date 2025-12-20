<?php

require_once __DIR__ . '/../core/Database.php';

class PortfolioRepository
{
    public function addStock(
        int $userId,
        int $stockId,
        int $quantity
    ): void {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'INSERT INTO portfolio (user_id, stock_id, quantity)
             VALUES (:u, :s, :q)
             ON CONFLICT (user_id, stock_id)
             DO UPDATE SET quantity = portfolio.quantity + :q'
        );

        $stmt->execute([
            'u' => $userId,
            's' => $stockId,
            'q' => $quantity
        ]);
    }

    public function getQuantity(int $userId, int $stockId): int
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare(
            'SELECT quantity FROM portfolio WHERE user_id = :u AND stock_id = :s'
        );
        $stmt->execute(['u' => $userId, 's' => $stockId]);

        $qty = $stmt->fetchColumn();
        return $qty ? (int)$qty : 0;
    }


    public function removeStock(int $userId, int $stockId, int $quantity): void
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'UPDATE portfolio
         SET quantity = quantity - :q
         WHERE user_id = :u AND stock_id = :s'
        );
        $stmt->execute(['q' => $quantity, 'u' => $userId, 's' => $stockId]);

        $pdo->prepare(
            'DELETE FROM portfolio
         WHERE user_id = :u AND stock_id = :s AND quantity <= 0'
        )->execute(['u' => $userId, 's' => $stockId]);

    }

    public function findByUser(int $userId): array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'SELECT p.stock_id, s.symbol, p.quantity
         FROM portfolio p
         JOIN stocks s ON s.id = p.stock_id
         WHERE p.user_id = :u
         ORDER BY s.symbol'
        );

        $stmt->execute(['u' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
