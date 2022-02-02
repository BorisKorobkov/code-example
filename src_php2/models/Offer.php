<?php

namespace models;

use framework\Logger;

class Offer implements OfferInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        Logger::getInstance()->debug('Offer: ' . print_r($data, true));
    }

    public function __get(string $name): mixed
    {
        $value = $this->data[$name] ?? null;

        // It's a dirty hack for XML, because it converts int and float to string
        // Convert back
        if (is_string($value) && is_numeric($value)) {
            if (strpos($value, '.')) {
                $value = (float)$value;
            } else {
                $value = (int)$value;
            }
        }

        return $value;
    }
}