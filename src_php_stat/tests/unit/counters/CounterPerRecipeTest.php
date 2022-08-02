<?php

namespace tests\unit\counters;

use src\counters\CounterPerRecipe;
use src\models\Order;
use tests\unit\UnitTest;

class CounterPerRecipeTest extends UnitTest
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

        $counterPerRecipe = new CounterPerRecipe();
        $this->test($counterPerRecipe::getId(), 'count_per_recipe');

        $counterPerRecipe->handleOrder($order1);
        $this->test($counterPerRecipe->getResult(), [
            [
                'recipe' => 'Speedy Steak Fajitas',
                'count' => 1,
            ],
        ]);

        $counterPerRecipe->handleOrder($order2);
        $this->test($counterPerRecipe->getResult(), [
            [
                'recipe' => 'Creamy Dill Chicken',
                'count' => 1,
            ],
            [
                'recipe' => 'Speedy Steak Fajitas',
                'count' => 1,
            ],
        ]);

        $counterPerRecipe->handleOrder($order3);
        $this->test($counterPerRecipe->getResult(), [
            [
                'recipe' => 'Creamy Dill Chicken',
                'count' => 2,
            ],
            [
                'recipe' => 'Speedy Steak Fajitas',
                'count' => 1,
            ],
        ]);
    }
}
