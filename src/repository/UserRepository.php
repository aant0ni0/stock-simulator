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

        $stmt = $pdo->prepare(
            'INSERT INTO users (email, password_hash) VALUES (:email, :hash)'
        );

        $stmt->execute([
            'email' => $email,
            'hash' => $passwordHash
        ]);
    }

}