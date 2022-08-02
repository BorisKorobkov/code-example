<?php

namespace src\counters;

use src\helpers\HourHelper;
use src\models\Order;

/**
 * Count the number of deliveries to postcode 10120 that lie within the delivery time between 10AM and 3PM.
 * Examples (12AM denotes midnight):
 *      NO - 9AM - 2PM
 *      YES - 10AM - 2PM
 * For example:
 *      "count_per_postcode_and_time": {
 *          "postcode": "10120",
 *          "from": "11AM",
 *          "to": "3PM",
 *          "delivery_count": 500
 *      }
 */
class CounterPerPostcodeAndPerTime implements CounterInterface
{
    private string $postcode;

    private string $hour12From;
    private string $hour12To;

    private string $hour24From;
    private string $hour24To;

    private int $count = 0;

    public function __construct(string $postcode, string $hour12From, string $hour12To)
    {
        $this->postcode = $postcode;

        $this->hour12From = $hour12From;
        $this->hour12To = $hour12To;

        // It's easier to compare 24H-format than 12H-format
        $this->hour24From = HourHelper::hour12ToHour24($hour12From);
        $this->hour24To = HourHelper::hour12ToHour24($hour12To);
    }

    public function handleOrder(Order $order): void
    {
        $postcode = $order->postcode;
        if ($postcode !== $this->postcode) {
            return;
        }

        [$hour12From, $hour12To] = $order->getDeliveryHours();
        $hour24From = HourHelper::hour12ToHour24($hour12From);
        $hour24To = HourHelper::hour12ToHour24($hour12To);

        if (
            $hour24From >= $this->hour24From &&
            $hour24To <= $this->hour24To
        ) {
            $this->count++;
        }
    }

    public static function getId(): string
    {
        return 'count_per_postcode_and_time';
    }

    public function getResult(): array
    {
        return [
            'postcode' => $this->postcode,
            'from' => $this->hour12From,
            'to' => $this->hour12To,
            'delivery_count' => $this->count,
        ];
    }
}
