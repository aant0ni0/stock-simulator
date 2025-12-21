<?php

require_once __DIR__ . '/../core/Database.php';

class LeaderboardRepository
{
    public function getLeaderboard(): array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->query(
            '
            SELECT
                u.id,
                u.email,
                u.cash
                + COALESCE(SUM(p.quantity * s.price), 0) AS total_value
            FROM users u
            LEFT JOIN portfolio p ON p.user_id = u.id
            LEFT JOIN stocks s ON s.id = p.stock_id
            GROUP BY u.id, u.email, u.cash
            ORDER BY total_value DESC
            '
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}