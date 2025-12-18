<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database;
use PDO;

class TasklistsRepository {
    public function __construct(private Database $database){}

    //show all tasklists
    public function getAllTasklists() {
        $sql = 'SELECT * FROM tasklists';
        
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //show tasklist by id
    public function getTasklist($tasklistid) {
        $sql = 'SELECT * FROM tasklists 
                WHERE tasklistid=:id';
        
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $tasklistid, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //create new tasklist
    public function addTasklist($data) {
        $sql = "INSERT INTO `tasklists`(`owner`, `title`) 
                VALUES (:owner, :title)";
        
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':owner', $data['owner'] ,PDO::PARAM_STR);
        $stmt->bindValue(':title', $data['title'] ,PDO::PARAM_STR);
        $stmt->execute();

        return $pdo->lastInsertId();
    }

    //edit tasklist by id
    public function editTasklist($id, $data) {
        $sql = "UPDATE `tasklists` 
                SET `owner`=:owner,`title`=:title 
                WHERE tasklistid=:id";
        
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':owner', $data['owner'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    //delete tasklist, decoulpe all tasks that where coupled
    public function deleteTasklist($tasklistid) {
        $pdo = $this->database->getConnection();
    
        $sql = "UPDATE `tasks` 
                SET `tasklistid`=NULL 
                WHERE tasklistid=:id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $tasklistid, PDO::PARAM_INT);
        $stmt->execute();
    
        $sql = "DELETE FROM tasklists 
                WHERE tasklistid=:id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $tasklistid, PDO::PARAM_INT);
        $stmt->execute();
    }

    //get list of users assigned to a task
    public function getTasklistUsers($id) {
        $sql = "SELECT tasks.taskid, users.userid, users.name
                FROM `tasklists`
                LEFT JOIN `tasks` ON tasks.tasklistid = tasklists.tasklistid
                LEFT JOIN `usertasks` ON tasks.taskid = usertasks.taskid
                LEFT JOIN `users` ON users.userid = usertasks.userid
                WHERE tasklists.tasklistid = :id";
        
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}