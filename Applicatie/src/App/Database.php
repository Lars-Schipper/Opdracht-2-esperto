<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class Database
{
    public function __construct(private string $host, 
                                private string $name,
                                private string $user,
                                private string $password)
    {
    }

    public function getConnection(): PDO
    {
        try {
            $pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->name, $this->user, $this->password);
            return $pdo;
        } catch (PDOException $err) {
            echo "Database connection problem: " . $err->getMessage();
            exit();
        }
    }
}
