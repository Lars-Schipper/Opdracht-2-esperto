<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\TaskRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use function PHPUnit\Framework\returnValue;

class Tasks
{
    public function __construct(private TaskRepository $repository){}

    public function getAllTasks(Request $request, Response $response): Response
    {
        $data = $this->repository->getAllTasks();
        $body = json_encode($data);
        $response->getBody()->write($body);

        return $response;
    }

    public function getTaskById(Request $request, Response $response, string $id): Response
    {
        $data = $this->repository->getTaskById($id);
        $body = json_encode($data);
        $response->getBody()->write($body);

        return $response;
    }

    public function createNewTask(Request $request, Response $response): Response 
    {
        $body = $request->getParsedBody();

        $id = $this->repository->createNewTask($body);
        $body = json_encode([
            'message'=>'task created',
            'id'=> $id
        ]);
        $response->getBody()->write($body);

        return $response->withStatus(201);
    }

    public function patchTask(Request $request, Response $response, string $id) {
        $body = $request->getParsedBody();

        $this->repository->patchTask($body, $id);
        $body = json_encode([
            'message' => 'task update',
            'id' => $id
        ]);
        $response->getBody()->write($body);

        return $response;
    }

    public function deleteTask(Request $request, Response $response, string $id) {
        $this->repository->deleteTask($id);

        $body = json_encode([
            'message' => 'user deleted',
            'id' => $id,
        ]);
        $response->getBody()->write($body);

        return $response;
    }

    public function taskUsers(Request $request, Response $response, string $id) {
        $data = $this->repository->taskUsers($id);
        $body = json_encode($data);
        $response->getBody()->write($body);

        return $response;
    }

    public function taskAddUser(Request $request, Response $response, string $id, string $userid) {
        $this->repository->taskAddUser($id, $userid);
        
        $body = json_encode([
            'message' => 'task added to user',
            'taskid' => $id,
            'userid' => $userid
        ]);
        $response->getBody()->write($body);

        return $response;
    }   

    //is deze functie echt nodig?
    public function taskChangeUser(Request $request, Response $response, string $id, string $userid) {
        $data = $this->repository->taskChangeUser($id, $userid);
        
        $body = json_encode($data);
        $response->getBody()->write($body);

        return $response;
    }

    public function taskDeleteUser(Request $request, Response $response, string $id, string $userid) {
        $this->repository->taskDeleteUser($id, $userid);
        
        $body = json_encode([
            'message' => 'Deleted user from task',
            'taskid' => $id,
            'userid' => $userid
        ]);
        $response->getBody()->write($body);

        return $response;
    }

    public function taskDeleteAllUsers(Request $request, Response $response, string $id) {
        $this->repository->taskDeleteAllUsers($id);
        
        $body = json_encode([
            'message' => 'Deleted all users from task',
            'taskid' => $id
        ]);
        $response->getBody()->write($body);

        return $response;
    }
}