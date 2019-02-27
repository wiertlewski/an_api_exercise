<?php

namespace Arek\Exercise\Action\Size;

use Arek\Exercise\ApiException;
use Arek\Exercise\HttpStatus;

class Calculate
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke($container, $request, $response, $arguments)
    {
        $items = (int) $arguments['items'];

        if ($items === 0) {
            throw new ApiException('Delta');
        }

        $sizes = $container->sizeTable->get();

        if (empty($sizes)) {
            throw new ApiException('Charlie');
        }

        $sizes = array_map(function ($row) {
            return (int) $row['size'];
        }, $sizes);

        $packsCalculator = new \Arek\Exercise\PacksCalculator($sizes, $items);

        return $response->withJson([
            'status' => HttpStatus::OK,
            'data' => [
                'items' => $items,
                'packs' => $packsCalculator->getNumberOfPacks(),
            ],
        ], HttpStatus::OK);
    }
}
