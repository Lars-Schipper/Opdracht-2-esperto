<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Repositories\UsersRepository;

class Users
{
    public function __construct(private UsersRepository $repository) {}

    //get all users
    public function getAllUsers(Request $request, Response $response): Response
    {
        $data = $this->repository->getAllUsers();

        $body = json_encode($data);
        $response->getBody()->write($body);

        return $response;
    }

    //get user by id
    public function getUserById(Request $request, Response $response, string $id): Response
    {
        $user = $this->repository->getUserById(intval($id));

        $body = json_encode($user);
        $response->getBody()->write($body);

        return $response;
    }

    //add new user
    public function addUser(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();

        $id = $this->repository->addUser($body);
        $body = json_encode([
            'message' => 'User created',
            'id' => $id
        ]);
        $response->getBody()->write($body);

        return $response->withStatus(201);
    }

    //update user by id
    public function updateUser(Request $request, Response $response, string $id)
    {
        $body = $request->getParsedBody();

        $this->repository->updateUser($body, $id);
        $body = json_encode([
            'message' => 'user Updated',
            'id' => $id
        ]);
        $response->getBody()->write($body);

        return $response;
    }

    //delete user by id
    public function deleteUser(Request $request, Response $response, string $id)
    {
        $this->repository->deleteUser($id);

        $body = json_encode([
            'message' => 'user Deleted',
            'id' => $id
        ]);
        $response->getBody()->write($body);

        return $response;
    }
    //get list of all tasklists user is the owner of
    public function getAllUserTasklists(Request $request, Response $response, string $id)
    {
        $data = $this->repository->getAllUserTasklists($id);
        $body = json_encode($data);
        $response->getBody()->write($body);

        return $response;
    }

    //get list of all tasks user is an employe of
    public function getAllUserTasks(Request $request, Response $response, string $id)
    {
        $data = $this->repository->getAllUserTasks($id);
        $body = json_encode($data);
        $response->getBody()->write($body);

        return $response;
    }
}
