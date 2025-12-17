<?php

declare(strict_types=1);


use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Slim\Handlers\Strategies\RequestResponseArgs;
use App\Middleware\AddJsonResponseHeader;
use App\Controllers\Users;
use Slim\App;

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

//get all users
$app->get('/api/users', [Users::class, 'getAllUsers']);

//get user by id
$app->get('/api/users/{id:[0-9]+}', [Users::class, 'getUserById']);

//create new user
$app->post('/api/users', [Users::class, 'create']);

//update user
$app->patch('/api/users/{id}', [Users::class, 'update']);

//delete user
$app->delete('/api/users/{id}', [Users::class, 'delete']);

$app->run();
