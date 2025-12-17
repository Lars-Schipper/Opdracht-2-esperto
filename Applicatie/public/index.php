<?php

declare(strict_types=1);


use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Slim\Handlers\Strategies\RequestResponseArgs;
use App\Middleware\AddJsonResponseHeader;
use App\Controllers\Users;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\Tasks;

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
    $group->post('/users', [Users::class, 'create']);
    
    //update user
    $group->patch('/users/{id}', [Users::class, 'update']);
    
    //delete user
    $group->delete('/users/{id}', [Users::class, 'delete']);

    //list of all tasklists user is the creator of

    //lsit of tasks the user is an employe of
});

//tasks
$app->group('/api', function (RouteCollectorProxy $group) {

    //get all tasks
    $group->get('/tasks', [Tasks::class, 'getAllTasks']);

    //get task by id
    $group->get('/tasks/{id}', [Tasks::class, 'getTaskById']);

    //je moet een nieuwe task kunnen aanmaken
    $group->post('/tasks', [Tasks::class, 'createNewTask']);

    //je moet een task kunnen aanpassen

    //je moet een task kunnen verwijderen
    $group->delete('/tasks/{id}', [Tasks::class, 'deleteTask']);
    //je wilt alle users van een task kunnen zien

    //je wilt users aan een task kunnen toevoegen

    //je wilt de users van een task kunnen wijzigen

    //je wilt een user van een task kunnen verwijderen

    //je wilt alle users van een task kunnen verwijderen
});



$app->run();
