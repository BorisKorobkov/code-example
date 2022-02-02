<?php

namespace models;

/**
 * Interface of Data Transfer Object, that represents external JSON data
 *
 * @property-read int $offerId
 * @property-read string $productTitle
 * @property-read array $vendor
 * @property-read float $price
 */
interface OfferInterface
{
    public function __construct(array $data);
}