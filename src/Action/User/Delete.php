<?php

namespace Arek\Exercise\Action\User;

use Arek\Exercise\ApiException;
use Arek\Exercise\HttpStatus;

class Delete
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke($container, $request, $response, $arguments)
    {
        if (!$container->userTable->getById($arguments['id'])) {
            throw new ApiException('Echo');
        }

        $container->userTable->delete($arguments['id']);

        return $response->withJson([
            'status' => HttpStatus::OK,
            'success' => 'User has been deleted',
        ], HttpStatus::OK);
    }
}
