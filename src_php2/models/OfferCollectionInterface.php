<?php

namespace models;

use Iterator;

/**
 * Interface for The Collection class that contains Offers
 */
interface OfferCollectionInterface
{
    public function __construct(array $data);

    public function get(int $index): OfferInterface;

    public function getIterator(): Iterator;
}