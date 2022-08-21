<?php

namespace tests\unit\counters;

use src\counters\CounterBusiestPostcode;
use src\models\Order;
use tests\unit\UnitTest;

class CounterBusiestPostcodeTest extends UnitTest
{
    public function run(): void
    {
        $order1 = new Order();
        $order1->postcode = '10208';
        $order1->recipe = 'Speedy Steak Fajitas';
        $order1->delivery = 'Thursday 7AM - 5PM';

        $order2 = new Order();
        $order2->postcode = '10120';
        $order2->recipe = 'Creamy Dill Chicken';
        $order2->delivery = 'Wednesday 1AM - 7PM';

        $order3 = new Order();
        $order3->postcode = '10120';
        $order3->recipe = 'Cherry Balsamic Pork Chops';
        $order3->delivery = 'Thursday 7AM - 9PM';

        $counterBusiestPostcode = new CounterBusiestPostcode();
        $this->test($counterBusiestPostcode::getId(), 'busiest_postcode');

        $counterBusiestPostcode->handleOrder($order1);
        $this->test($counterBusiestPostcode->getResult(), [
            'postcode' => '10208',
            'delivery_count' => 1,
        ]);

        $counterBusiestPostcode->handleOrder($order2);
        $this->test($counterBusiestPostcode->getResult(), [
            'postcode' => '10208',
            'delivery_count' => 1,
        ]);

        $counterBusiestPostcode->handleOrder($order3);
        $this->test($counterBusiestPostcode->getResult(), [
            'postcode' => '10120',
            'delivery_count' => 2,
        ]);
    }
}
