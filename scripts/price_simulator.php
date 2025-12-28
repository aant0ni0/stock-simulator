<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/core/Database.php';

$pdo = Database::getConnection();

$stmt = $pdo->query('SELECT id, price FROM stocks');
$stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$stocks) {
    echo "No stocks found.\n";
    exit;
}

$minChange = -1.0;
$maxChange =  1.0;

foreach ($stocks as $stock) {

    $oldPrice = (float)$stock['price'];

    $changePercent = mt_rand(
            (int)($minChange * 100),
            (int)($maxChange * 100)
        ) / 100;

    $newPrice = $oldPrice * (1 + $changePercent / 100);

    if ($newPrice < 1) {
        $newPrice = 1;
    }

    $newPrice = round($newPrice, 2);

    $stmtHistory = $pdo->prepare(
        'INSERT INTO stock_price_history (stock_id, price)
         VALUES (:stock_id, :price)'
    );

    $stmtHistory->execute([
        'stock_id' => $stock['id'],
        'price'    => $newPrice
    ]);

    $stmtUpdate = $pdo->prepare(
        'UPDATE stocks
         SET price = :price,
             price_updated_at = NOW()
         WHERE id = :id'
    );

    $stmtUpdate->execute([
        'price' => $newPrice,
        'id'    => $stock['id']
    ]);

    echo "Stock {$stock['id']} updated: {$oldPrice} → {$newPrice}\n";
}

$stmtUsers = $pdo->query('SELECT id, cash FROM users');
$users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {

    $stmtValue = $pdo->prepare(
        'SELECT COALESCE(SUM(p.quantity * s.price), 0)
         FROM portfolio p
         JOIN stocks s ON s.id = p.stock_id
         WHERE p.user_id = :uid'
    );
    $stmtValue->execute(['uid' => $user['id']]);
    $holdingsValue = (float)$stmtValue->fetchColumn();

    $totalValue = (float)$user['cash'] + $holdingsValue;

    $stmtInsert = $pdo->prepare(
        'INSERT INTO user_portfolio_snapshots (user_id, total_value)
         VALUES (:uid, :value)'
    );

    $stmtInsert->execute([
        'uid'   => $user['id'],
        'value' => $totalValue
    ]);
}


echo "Price simulation finished.\n";
