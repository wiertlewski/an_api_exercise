<?php

namespace Arek\Exercise\Action\Size;

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
            return $container->sizeTable->getById((int) $request->getParam('id'));
        } elseif ($request->getParam('size')) {
            return $container->sizeTable->getBySize((int) $request->getParam('size'));
        }

        return $container->sizeTable->get();
    }
}
