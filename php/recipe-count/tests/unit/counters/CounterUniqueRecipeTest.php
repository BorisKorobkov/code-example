<?php

namespace tests\unit\counters;

use src\counters\CounterUniqueRecipe;
use src\models\Order;
use tests\unit\UnitTest;

class CounterUniqueRecipeTest extends UnitTest
{
    public function run(): void
    {
        $order1 = new Order();
        $order1->postcode = '10208';
        $order1->recipe = 'Speedy Steak Fajitas';
        $order1->delivery = 'Thursday 7AM - 5PM';

        $order2 = new Order();
        $order2->postcode = '10208';
        $order2->recipe = 'Creamy Dill Chicken';
        $order2->delivery = 'Wednesday 1AM - 7PM';

        $order3 = new Order();
        $order3->postcode = '10120';
        $order3->recipe = 'Creamy Dill Chicken';
        $order3->delivery = 'Thursday 7AM - 9PM';

        $counterUniqueRecipe = new CounterUniqueRecipe();
        $this->test($counterUniqueRecipe::getId(), 'unique_recipe_count');

        $counterUniqueRecipe->handleOrder($order1);
        $this->test($counterUniqueRecipe->getResult(), 1);

        $counterUniqueRecipe->handleOrder($order2);
        $this->test($counterUniqueRecipe->getResult(), 2);

        $counterUniqueRecipe->handleOrder($order3);
        $this->test($counterUniqueRecipe->getResult(), 2);
    }
}
