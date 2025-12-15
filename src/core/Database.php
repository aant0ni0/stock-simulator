<?php


class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): ?PDO
    {
        if (self::$connection === null) {
            $host = 'db';
            $db   = 'stock_sim';
            $user = 'stock_user';
            $pass = 'stock_pass';

            $dsn = "pgsql:host=$host;dbname=$db";

            self::$connection = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        }

        return self::$connection;
    }
}