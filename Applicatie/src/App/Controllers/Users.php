<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Repositories\UsersRepository;

class Users
{
    public function __construct(private UsersRepository $repository) {}

    public function getAllUsers(Request $request, Response $response): Response
    {
        $data = $this->repository->getAllUsers();
        
        $body = json_encode($data);
        
        $response->getBody()->write($body);
        
        return $response;
    }
    
    public function getUserById(Request $request, Response $response, string $id): Response
    {
        // $user = $request->getAttribute('user');

        $user = $this->repository->getUserById(intval($id));

        $body = json_encode($user);

        $response->getBody()->write($body);

        return $response;
    }

    public function create(Request $request, Response $response): Response {
        $body = $request->getParsedBody();

        $id = $this->repository->create($body);

        $body = json_encode([
            'message' => 'User created',
            'id' => $id
        ]);

        $response->getBody()->write($body);

        return $response->withStatus(201);
    }

    public function update(Request $request, Response $response, string $id) {
        $body = $request->getParsedBody();

        $name = $this->repository->update($body, $id);

        $body = json_encode([
            'message' => 'user Updated',
            'id' => $id
        ]);

        $response->getBody()->write($body);

        return $response;
    }

    public function delete(Request $request, Response $response, string $id) {
        $this->repository->delete($id);
        
        $body = json_encode([
            'message' => 'user Deleted',
            'id' => $id
        ]);

        $response->getBody()->write($body);

        return $response;
    }
}
