<?php

namespace Arek\Exercise\Action\User;

use Arek\Exercise\ApiException;
use Arek\Exercise\HttpStatus;

class Create
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke($container, $request, $response, $arguments)
    {
        return $response->withJson([
            'status' => HttpStatus::OK,
            'success' => 'User has been created',
        ], HttpStatus::OK);
    }
}
