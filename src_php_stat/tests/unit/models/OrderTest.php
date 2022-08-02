<?php

namespace tests\unit\models;

use src\models\Order;
use tests\unit\UnitTest;

class OrderTest extends UnitTest
{
    public function run(): void
    {
        $order = new Order();
        $order->postcode = '10208';
        $order->recipe = 'Speedy Steak Fajitas';
        $order->delivery = 'Thursday 7AM - 5PM';

        $this->test($order->postcode, '10208');
        $this->test($order->recipe, 'Speedy Steak Fajitas');
        $this->test($order->delivery, 'Thursday 7AM - 5PM');

        [$hour12From, $hour12To] = $order->getDeliveryHours();
        $this->test($hour12From, '7AM');
        $this->test($hour12To, '5PM');
    }
}
