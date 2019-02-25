<?php

namespace Arek\Exercise\Action\Size;

use Arek\Exercise\ApiException;
use Arek\Exercise\HttpStatus;

class Create
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke($container, $request, $response, $arguments)
    {
        $validatedBody = $container->sizeValidator->validate($request->getParsedBody());

        if ($container->sizeTable->getBySize($validatedBody['size'])) {
            throw new ApiException('Foxtrot');
        }

        $container->sizeTable->create($validatedBody);

        return $response->withJson([
            'status' => HttpStatus::OK,
            'success' => 'Pack Size has been created',
        ], HttpStatus::OK);
    }
}
