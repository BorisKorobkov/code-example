<?php

namespace controllers;

use framework\Controller;
use framework\Logger;
use InvalidArgumentException;

class CountByVendorId extends Controller
{
    public function run(array $argv): int
    {
        if (count($argv) !== 1) {
            throw new InvalidArgumentException('vendorId is not specified');
        }
        $vendorId = (int)$argv[0];

        $count = $this->count($vendorId);
        $logMessage = sprintf('CountByPriceRange. vendorId=%d, count=%d', $vendorId, $count);
        Logger::getInstance()->info($logMessage);
        return $count;
    }

    private function count(int $vendorId): int
    {
        $count = 0;
        $offerCollection = $this->getOfferCollection();
        foreach ($offerCollection->getIterator() as $offer) {
            $offerVendorId = $offer->vendor['id'] ?? null;
            if ($offerVendorId === $vendorId) {
                $count++;
            }
        }

        return $count;
    }
}