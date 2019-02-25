<?php

namespace Arek\Exercise\Action\Size;

use Arek\Exercise\ApiException;
use Arek\Exercise\HttpStatus;

class Delete
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke($container, $request, $response, $arguments)
    {
        if (!$container->sizeTable->getById($arguments['id'])) {
            throw new ApiException('Echo');
        }

        $container->sizeTable->delete($arguments['id']);

        return $response->withJson([
            'status' => HttpStatus::OK,
            'success' => 'Pack Size has been deleted',
        ], HttpStatus::OK);
    }
}
