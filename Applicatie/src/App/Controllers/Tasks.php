<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\TaskRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

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

    public function patchTask() {}

    public function deleteTask(Request $request, Response $response, string $id) {
        $this->repository->deleteTask($id);

        $body = json_encode([
            'message' => 'user deleted',
            'id' => $id,
        ]);

        $response->getBody()->write($body);

        return $response;
    }
}