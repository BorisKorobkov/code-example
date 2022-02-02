<?php

namespace models;

use framework\Logger;
use Iterator;
use RuntimeException;

class OfferCollection implements OfferCollectionInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        Logger::getInstance()->debug('OfferCollection: ' . print_r($data, true));
    }

    public function get(int $index): OfferInterface
    {
        Logger::getInstance()->debug('OfferCollection get: ' . $index);

        $offerData = $this->data[$index] ?? null;
        if (!is_array($offerData)) {
            throw new RuntimeException('Wrong index ' . $index);
        }
        return new Offer($offerData);
    }

    public function getIterator(): Iterator
    {
        foreach ($this->data as $index => $value) {
            yield $this->get($index);
        }
    }
}