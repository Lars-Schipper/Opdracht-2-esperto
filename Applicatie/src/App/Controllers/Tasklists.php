<?php 

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Repositories\TasklistsRepository;

class Tasklists 
{
    public function __construct(private TasklistsRepository $repository) {}

    //get all tasklists in database
    public function getAllTasklists(Request $request, Response $response) {
        $data = $this->repository->getAllTasklists();

        $body = json_encode($data);
        $response->getBody()->write($body);

        return $response;
    }

    //get tasklist by id
    public function getTasklist(Request $request, Response $response, string $id) {
        $data = $this->repository->getTasklist($id);

        $body=json_encode($data);
        $response->getBody()->write($body);

        return $response;
    }

    //create new tasklist
    public function addTasklist(Request $request, Response $response) {
        $data = $request->getParsedBody();

        $id = $this->repository->addTasklist($data);
        $body=json_encode([
            'message' => 'new tasklist created',
            'id'=> $id,
        ]);
        $response->getBody()->write($body);

        return $response->withStatus(201); 
    }

    //edit tasklist by id
    public function editTasklist(Request $request, Response $response, string $id) {
        $data = $request->getParsedBody();
        
        $this->repository->editTasklist($id, $data);
        $body=json_encode([
            'message' => 'edited task',
            'id' => $id
        ]);
        $response->getBody()->write($body);

        return $response->withStatus(201);
    }

    //delete tasklist by id
    public function deleteTasklist(Request $request, Response $response, string $id) {
        $this->repository->deleteTasklist($id);

        $body = json_encode([
            'message' => 'Deleted tasklist',
            'tasklistid' => $id
        ]);
        $response->getBody()->write($body);

        return $response;
    }

    //get list of users assigne to task
    public function getTasklistUsers(Request $request, Response $response, string $id) {
        $data = $this->repository->getTasklistUsers($id);
        $body = json_encode($data);
        $response->getBody()->write($body);
        
        return $response;
    }
}