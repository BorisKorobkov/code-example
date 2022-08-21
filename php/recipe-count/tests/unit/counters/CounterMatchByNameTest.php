<?php

namespace tests\unit\counters;

use src\counters\CounterMatchByName;
use src\models\Order;
use tests\unit\UnitTest;

class CounterMatchByNameTest extends UnitTest
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
        $order3->recipe = 'Creamy Balsamic Pork Chops';
        $order3->delivery = 'Thursday 7AM - 9PM';

        $counterMatchByName = new CounterMatchByName('    Creamy,Chicken   ');
        $this->test($counterMatchByName::getId(), 'match_by_name');

        $counterMatchByName->handleOrder($order1);
        $this->test($counterMatchByName->getResult(), []);

        $counterMatchByName->handleOrder($order2);
        $this->test($counterMatchByName->getResult(), [
            'Creamy Dill Chicken',
        ]);

        $counterMatchByName->handleOrder($order3);
        $this->test($counterMatchByName->getResult(), [
            'Creamy Balsamic Pork Chops',
            'Creamy Dill Chicken',
        ]);
    }
}
