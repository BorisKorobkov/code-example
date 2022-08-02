<?php

namespace tests\unit\counters;

use src\counters\CounterPerPostcodeAndPerTime;
use src\models\Order;
use tests\unit\UnitTest;

class CounterPerPostcodeAndPerTimeTest extends UnitTest
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

        $counterPerPostcodeAndPerTime = new CounterPerPostcodeAndPerTime('10120', '1AM', '10PM');
        $this->test($counterPerPostcodeAndPerTime::getId(), 'count_per_postcode_and_time');

        $counterPerPostcodeAndPerTime->handleOrder($order1);
        $this->test($counterPerPostcodeAndPerTime->getResult(), [
            'postcode' => '10120',
            'from' => '1AM',
            'to' => '10PM',
            'delivery_count' => 0,
        ]);

        $counterPerPostcodeAndPerTime->handleOrder($order2);
        $this->test($counterPerPostcodeAndPerTime->getResult(), [
            'postcode' => '10120',
            'from' => '1AM',
            'to' => '10PM',
            'delivery_count' => 1,
        ]);

        $counterPerPostcodeAndPerTime->handleOrder($order3);
        $this->test($counterPerPostcodeAndPerTime->getResult(), [
            'postcode' => '10120',
            'from' => '1AM',
            'to' => '10PM',
            'delivery_count' => 2,
        ]);
    }
}
