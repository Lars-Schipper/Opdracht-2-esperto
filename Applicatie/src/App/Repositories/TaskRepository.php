<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database;
use PDO;

class TaskRepository
{

    public function __construct(private Database $database) {}

    public function getAllTasks(): array
    {
        $sql = 'SELECT * FROM tasks';

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaskById($id): array
    {
        $sql = "SELECT * FROM tasks WHERE taskid=:id";

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', intval($id), PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createNewTask(array $data): string {
        $sql = "INSERT INTO tasks (tasklistid, title, description, status, creator, employe) VALUE (:tasklistid, :title, :description, :status, :creator, :employe)";

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tasklistid', $data['tasklistid'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(':status', $data['status'], PDO::PARAM_STR);
        $stmt->bindValue(':creator', $data['creator'], PDO::PARAM_STR);
        $stmt->bindValue(':employe', $data['employe'], PDO::PARAM_STR);
        $stmt->execute();

        return $pdo->lastInsertId();
    }

    public function patchTask() {}

    public function deleteTask($id) {
        $sql = "DELETE FROM tasks WHERE taskid=:id";

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
