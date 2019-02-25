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

$container['sizeTable'] = function ($container) {
    return new \Arek\Exercise\Size\Table($container->dbHelper);
};

$container['sizeValidator'] = function ($container) {
    return new \Arek\Exercise\Size\Validator();
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

$app->post('/size', 'controller:Size_Create');
$app->get('/size', 'controller:Size_Read');
$app->delete('/size/{id:[0-9]+}', 'controller:Size_Delete');
$app->get('/calculate/{items:[0-9]+}', 'controller:Size_Calculate');

$app->run();
