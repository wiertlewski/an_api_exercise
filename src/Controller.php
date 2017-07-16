<?php

namespace Arek\Exercise;

class Controller
{
    private $container;

    public function __construct(\Slim\Container $container)
    {
        $this->container = $container;
    }

    public function __call($method, $arguments)
    {
        $action = $this->getAction($method);

        return $this->dispatchAction($action, ...$arguments);
    }

    private function getAction($method)
    {
        $action = '\\Arek\\Exercise\\Action\\' . str_replace('_', '\\', $method);

        return new $action;
    }

    private function dispatchAction(callable $action, $request, $response, $arguments)
    {
        try {
            return $action($this->container, $request, $response, $arguments);
        } catch (ApiException $exception) {
            $error = $this->getError($exception->getMessage());

            $this->container->logger->log('ApiException', $error['log'], array());

            return $response->withJson([
                'status' => $error['status'],
                'error' => $error['message'],
            ], $error['status']);
        }
    }

    private function getError($exceptionMessage)
    {
        return $this->container->errors[$exceptionMessage] ?: [
            'status' => HttpStatus::SERVICE_UNAVAILABLE,
            'message' => 'Service unavailable.',
            'log' => $exceptionMessage,
        ];
    }
}
