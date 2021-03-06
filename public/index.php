<?php

define('APP_ENV', getenv('APP_ENV') ?: 'production');

define('ROOT_PATH', __DIR__ . '/..');

require ROOT_PATH . '/vendor/autoload.php';

session_start();

$settings = require ROOT_PATH . '/config/' . APP_ENV . '/settings.php';
$errors = require ROOT_PATH . '/config/' . 'errors.php';

$app = new \Slim\App(array_merge($settings, [
    'errors' => $errors,
]));

$container = $app->getContainer();

$container['dbHelper'] = function ($container) {
    return new \Arek\Exercise\DbHelper($container->database);
};

$container['userTable'] = function ($container) {
    return new \Arek\Exercise\User\Table($container->dbHelper);
};

$container['userValidator'] = function ($container) {
    return new \Arek\Exercise\User\Validator();
};

$container['controller'] = function ($container) {
    return new \Arek\Exercise\Controller($container);
};

$container['logger'] = function ($container) {
    return new \Arek\Exercise\Logger(ROOT_PATH . '/logs/');
};

$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $response->withJson([
            'status' => \Arek\Exercise\HttpStatus::NOT_FOUND,
            'error' => 'Page not found.',
        ], \Arek\Exercise\HttpStatus::NOT_FOUND);
    };
};

$app->add(new \Arek\Exercise\AuthMiddleware($container->credentials));

$app->post('/user', 'controller:User_Create');
$app->get('/user', 'controller:User_Read');
$app->put('/user/{id:[0-9]+}', 'controller:User_Update');
$app->delete('/user/{id:[0-9]+}', 'controller:User_Delete');

$app->run();
