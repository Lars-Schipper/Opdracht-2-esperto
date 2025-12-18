<?php

declare(strict_types=1);


use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Slim\Handlers\Strategies\RequestResponseArgs;
use App\Middleware\AddJsonResponseHeader;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\Users;
use App\Controllers\Tasks;
use App\Controllers\Tasklists;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

$builder = new ContainerBuilder();
$container = $builder->addDefinitions(APP_ROOT . '/config/definitions.php')->build();
AppFactory::setContainer($container);

$app = AppFactory::create();

$collector = $app->getRouteCollector();
$collector->setDefaultInvocationStrategy(new RequestResponseArgs);

$app->addBodyParsingMiddleware();

$error_middleware = $app->addErrorMiddleware(true, true, true);
$error_handler = $error_middleware->getDefaultErrorHandler();
$error_handler->forceContentType('application/json');

$app->add(new AddJsonResponseHeader);

//users:
$app->group('/api', function (RouteCollectorProxy $group) {
    //get all users
    $group->get('/users', [Users::class, 'getAllUsers']);

    //get user by id
    $group->get('/users/{id:[0-9]+}', [Users::class, 'getUserById']);

    //create new user
    $group->post('/users', [Users::class, 'addUser']);

    //update user
    $group->patch('/users/{id}', [Users::class, 'updateUser']);

    //delete user
    $group->delete('/users/{id}', [Users::class, 'deleteUser']);

    //list of all tasklists user is the creator of
    $group->get('/users/{id}/tasklists', [Users::class, 'getAllUserTasklists']);

    //lsit of tasks the user is an employe of
    $group->get('/users/{id}/tasks', [Users::class, 'getAllUserTasks']);
});

//tasks
$app->group('/api', function (RouteCollectorProxy $group) {

    //get all tasks
    $group->get('/tasks', [Tasks::class, 'getAllTasks']);

    //get task by id
    $group->get('/tasks/{id}', [Tasks::class, 'getTaskById']);

    //create new task
    $group->post('/tasks', [Tasks::class, 'createNewTask']);

    //edit task
    $group->patch('/tasks/{id}', [Tasks::class, 'patchTask']);

    //delete task
    $group->delete('/tasks/{id}', [Tasks::class, 'deleteTask']);

    //get all users of a task
    $group->get('/tasks/{id}/users', [Tasks::class, 'taskUsers']);

    //add user to task
    $group->post('/tasks/{id}/users/{userid}', [Tasks::class, 'taskAddUser']);

    //je wilt de users van een task kunnen wijzigen
    //is deze nodig????
    // $group->patch('/tasks/{id}/users/{userid}', [Tasks::class, 'taskChangeUser']);

    //delete user from task
    $group->delete('/tasks/{id}/users/{userid}', [Tasks::class, 'taskDeleteUser']);

    //delete all users from task
    $group->delete('/tasks/{id}/users', [Tasks::class, 'taskDeleteAllUsers']);
});

//tasklists
$app->group('/api', function (RouteCollectorProxy $group) {
    //get all tasklists
    $group->get('/tasklists', [Tasklists::class, 'getAllTasklists']);

    //get one task by id
    $group->get('/tasklists/{id}', [Tasklists::class, 'getTasklist']);

    //create new tasklist
    $group->post('/tasklists', [Tasklists::class, 'addTasklist']);

    //edit tasklist
    $group->post('/tasklists/{id}', [Tasklists::class, 'editTasklist']);

    //delete tasklist
    $group->delete('/tasklists/{id}', [Tasklists::class, 'deleteTasklist']);

    //get list of users assigned to a task
    $group->get('/tasklists/{id}/users', [Tasklists::class, 'getTasklistUsers']);
});

$app->run();
