<?php

namespace src\models;

use stdClass;

class Order
{
    public string $postcode = '';
    public string $recipe = '';
    public string $delivery = '';

    public function __construct(stdClass $stdClass)
    {
        foreach ($stdClass as $fakeJsonKey => $fakeJsonValue) {
            $this->{$fakeJsonKey} = $fakeJsonValue;
        }
    }

    /**
     * @return string[] [$hour12From, $hour12To]
     */
    public function getDeliveryHours(): array
    {
        // Property value "delivery" always has the following format: "{weekday} {h}AM - {h}PM", i.e. "Monday 9AM - 5PM"
        // explode() is much more quicker then RegExp "([A-Za-z]+) (\d+)(AM|PM) \- (\d+)(AM|PM)"
        $deliveryArray = explode(' ', $this->delivery);
        // 0 - weekday
        // 1 - hour in 12-hour clock
        // 2 - "-"
        // 3 - hour in 12-hour clock
        $hour12From = $deliveryArray[1];
        $hour12To = $deliveryArray[3];

        return [$hour12From, $hour12To];
    }
}
