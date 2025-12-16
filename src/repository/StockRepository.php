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
}