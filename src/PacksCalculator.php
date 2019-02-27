<?php

namespace Arek\Exercise;

class PacksCalculator
{
    private $sizes;
    private $items;
    private $results;
    private $packs;

    public function __construct(array $sizes, int $items)
    {
        $this->sizes = $sizes;
        $this->items = $items;

        $this->run();
    }

    public function getNumberOfPacks()
    {
        return $this->packs;
    }

    private function run()
    {
        foreach ($this->sizes as $size) {
            $this->calculate('', 0, $size);
        }

        $this->minimumItemsOnly();

        foreach ($this->results as $result) {
            $this->packs[$result] = count(explode('.', $result));
        }

        $this->minimumNumberOfPacks();

        if (!empty($this->packs)) {
            $this->packs = explode('.', $this->packs[0]);
        }
    }

    private function calculate(string $prevKey, int $prevValue, int $currentSize)
    {
        foreach ($this->sizes as $size) {
            $newKey = !empty($prevKey) ? implode('.', [$prevKey, $currentSize]) : $currentSize;
            $newValue = $prevValue + $currentSize;

            if ($newValue >= $this->items) {
                $this->results[$newKey] = $newValue;
                return;
            }

            $this->calculate($newKey, $newValue, $size);
        }
    }

    private function minimumItemsOnly()
    {
        $this->results = array_keys($this->results, min($this->results));
    }

    private function minimumNumberOfPacks()
    {
        $this->packs = array_keys($this->packs, min($this->packs));
    }
}
