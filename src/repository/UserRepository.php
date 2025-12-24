<?php

require_once __DIR__ . '/../core/Database.php';

class UserRepository
{
    public function findByEmail(string $email): ?array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function create(string $email, string $passwordHash): void
    {
        $pdo = Database::getConnection();

        $username = explode('@', $email)[0];

        $stmt = $pdo->prepare(
            'INSERT INTO users (username, email, password_hash)
         VALUES (:username, :email, :password)'
        );

        $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'password' => $passwordHash
        ]);
    }


    public function getCash(int $userId): float
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'SELECT cash FROM users WHERE id = :id'
        );
        $stmt->execute(['id' => $userId]);

        return (float)$stmt->fetchColumn();
    }

    public function updateCash(int $userId, float $amount): void
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'UPDATE users SET cash = cash + :amount WHERE id = :id'
        );
        $stmt->execute([
            'amount' => $amount,
            'id' => $userId
        ]);
    }

}