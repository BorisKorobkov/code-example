<?php

namespace src\counters;

use src\models\Order;

/**
 * Find the postcode with most delivered recipes
 * For example:
 *      "busiest_postcode": {
 *          "postcode": "10120",
 *          "delivery_count": 1000
 *      }
 */
class CounterBusiestPostcode implements CounterInterface
{
    /**
     * @var int[]
     * key - unique postcode
     * value - count
     */
    private array $uniquePostcodes = [];

    public function handleOrder(Order $order): void
    {
        $postcode = $order->postcode;
        if (isset($this->uniquePostcodes[$postcode])) {
            $this->uniquePostcodes[$postcode]++;
        } else {
            $this->uniquePostcodes[$postcode] = 1;
        }
    }

    public static function getId(): string
    {
        return 'busiest_postcode';
    }

    public function getResult(): array
    {
        $postcodeWithMaxCount = null;
        $maxCount = null;

        foreach ($this->uniquePostcodes as $postcode => $count) {
            if ($maxCount === null || $count > $maxCount) {
                $postcodeWithMaxCount = $postcode;
                $maxCount = $count;
            }
        }

        return [
            'postcode' => (string)$postcodeWithMaxCount,
            'delivery_count' => $maxCount,
        ];
    }
}
