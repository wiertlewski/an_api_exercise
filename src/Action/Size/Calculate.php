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

        $sizes = $this->reorderedSizes($sizes);

        return $response->withJson([
            'status' => HttpStatus::OK,
            'data' => [
                'items' => $items,
                'packs' => $this->calcPacks($sizes, $items),
            ],
        ], HttpStatus::OK);
    }

    private function calcPacks(array $sizes, int $items)
    {
        $packs = [];

        foreach ($sizes as $size) {
            $number = intdiv($items, $size);
            if ($number > 0) {
                $packs[$size] += $number;
                $items = $items % $size;
            }
        }

        if ($items > 0) {
            $packs[$size] += 1;
        }

        return $packs;
    }

    private function reorderedSizes(array $sizes)
    {
        $result = array_map(function ($row) {
            return (int) $row['size'];
        }, $sizes);

        rsort($result, SORT_NUMERIC);

        return $result;
    }
}
