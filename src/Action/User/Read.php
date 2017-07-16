<?php

namespace Arek\Exercise\Action\User;

use Arek\Exercise\ApiException;
use Arek\Exercise\HttpStatus;

class Read
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke($container, $request, $response, $arguments)
    {
        return $response->withJson([
            'status' => HttpStatus::OK,
            'data' => $this->getData($container, $request),
        ], HttpStatus::OK);
    }

    private function getData($container, $request)
    {
        if ($request->getParam('id')) {
            return $container->userTable->getById((int) $request->getParam('id'));
        } elseif ($request->getParam('email')) {
            return $container->userTable->getByEmail((string) $request->getParam('email'));
        }

        return $container->userTable->get();
    }
}
