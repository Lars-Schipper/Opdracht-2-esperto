<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database;
use PDO;
use Symfony\Component\VarDumper\VarDumper;

class UsersRepository {
    
    public function __construct(private Database $database)
    {
    }

    public function getAllUsers(): array {
         $sql = 'SELECT * FROM users';

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById(int $id): array|bool {

        $sql = 'SELECT users.name, users.email FROM users WHERE users.userid = :id';
        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO users (name, email) VALUE (:name, :email)";
        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->execute();

        return $pdo->lastInsertId();
    }

    public function update(array $data, $id)
    {
        $sql = "UPDATE users SET name=:name, email=:email WHERE userid = :id";

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM users WHERE userid=:id";

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}