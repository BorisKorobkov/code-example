<?php

namespace controllers;

use framework\Controller;
use framework\Logger;
use InvalidArgumentException;

class CountByPriceRange extends Controller
{
    public function run(array $argv): int
    {
        if (count($argv) !== 2) {
            throw new InvalidArgumentException('priceFrom and priceTo are not specified');
        }
        $priceFrom = (float)$argv[0];
        $priceTo = (float)$argv[1];

        $count = $this->count($priceFrom, $priceTo);
        $logMessage = sprintf('CountByPriceRange. priceFrom=%.2f, priceTo=%.2f, count=%d', $priceFrom, $priceTo, $count);
        Logger::getInstance()->info($logMessage);
        return $count;
    }

    private function count(float $priceFrom, float $priceTo): int
    {
        $count = 0;
        $offerCollection = $this->getOfferCollection();
        foreach ($offerCollection->getIterator() as $offer) {
            if ($offer->price >= $priceFrom && $offer->price <= $priceTo) {
                $count++;
            }
        }

        return $count;
    }
}