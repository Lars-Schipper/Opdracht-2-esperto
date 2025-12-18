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
        $sql = "SELECT * 
                FROM tasks 
                WHERE taskid=:id";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', intval($id), PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createNewTask(array $data): string
    {
        $sql = "INSERT INTO tasks (tasklistid, title, description, status, creator) 
                VALUE (:tasklistid, :title, :description, :status, :creator)";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tasklistid', $data['tasklistid'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(':status', $data['status'], PDO::PARAM_STR);
        $stmt->bindValue(':creator', $data['creator'], PDO::PARAM_STR);
        $stmt->execute();

        return $pdo->lastInsertId();
    }

    public function patchTask(array $data, $id)
    {
        $sql = "UPDATE tasks 
                SET tasklistid=:tasklistid, title=:title, description=:description, status=:status, creator=:creator 
                WHERE taskid=:taskid";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tasklistid', $data['tasklistid'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(':status', $data['status'], PDO::PARAM_STR);
        $stmt->bindValue(':creator', $data['creator'], PDO::PARAM_STR);
        $stmt->bindValue(':taskid', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteTask($id)
    {
        $sql = "DELETE FROM tasks 
                WHERE taskid=:id";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function taskUsers($id)
    {
        $sql = "SELECT taskid, userid 
                FROM `usertasks` 
                WHERE taskid=:id";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function taskAddUser($id, $userid) {
        $sql = "INSERT INTO usertasks (userid, taskid) 
                VALUES (:userid, :taskid);";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindValue('taskid', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function taskChangeUser($id, $userid)
    {
        $sql = "UPDATE tasks 
                SET employe=:userid 
                WHERE taskid=:id";
        
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function taskDeleteUser($id, $userid) {
        $sql = "DELETE FROM usertasks 
                WHERE userid=:userid AND taskid=:id";
        
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function taskDeleteAllUsers($id) {
        $sql = "DELETE FROM usertasks 
                WHERE taskid=:id";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
