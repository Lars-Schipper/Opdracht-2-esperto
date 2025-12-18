<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database;
use PDO;

class UsersRepository {
    
    public function __construct(private Database $database){}

    //get all users
    public function getAllUsers(): array {
        $sql = 'SELECT * FROM users';

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //get user by id
    public function getUserById(int $id): array|bool {

        $sql = 'SELECT users.name, users.email 
                FROM users 
                WHERE users.userid = :id';
        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //add new user
    public function addUser(array $data): string
    {
        $sql = "INSERT INTO users (name, email) 
                VALUE (:name, :email)";
        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->execute();

        return $pdo->lastInsertId();
    }

    //update user by id
    public function updateUser(array $data, $id)
    {
        $sql = "UPDATE users 
                SET name=:name, email=:email 
                WHERE userid = :id";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    //delete user by id
    public function deleteUser($id) {
        $sql = "DELETE FROM users 
                WHERE userid=:id";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    //get list of all tasklists user is the owner of
    public function getAllUserTasklists($id) {
        $sql = "SELECT users.userid, tasklists.tasklistid
                FROM users
                LEFT JOIN tasklists ON users.userid = tasklists.owner
                WHERE users.userid = :id";
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //get list of all tasks user is an employe of
    public function getAllUserTasks($id) {
        $sql = "SELECT users.userid, tasks.taskid
                FROM users
                LEFT JOIN usertasks ON users.userid = usertasks.userid
                LEFT JOIN tasks ON usertasks.taskid = tasks.taskid
                WHERE users.userid = :id";

        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}