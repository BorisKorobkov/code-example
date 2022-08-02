<?php

namespace src\counters;

use src\models\Order;

/**
 * Count the number of occurrences for each unique recipe name (alphabetically ordered by recipe name)
 * For example:
 *      "count_per_recipe": [
 *          {
 *              "recipe": "Mediterranean Baked Veggies",
 *              "count": 1
 *          },
 *          {
 *              "recipe": "Speedy Steak Fajitas",
 *              "count": 1
 *          },
 *          {
 *              "recipe": "Tex-Mex Tilapia",
 *              "count": 3
 *          }
 *      ]
 */
class CounterPerRecipe implements CounterInterface
{
    /**
     * @var int[]
     * key - unique recipe name
     * value - count
     */
    private array $uniqueNames = [];

    public function handleOrder(Order $order): void
    {
        $recipeName = $order->recipe;
        if (isset($this->uniqueNames[$recipeName])) {
            $this->uniqueNames[$recipeName]++;
        } else {
            $this->uniqueNames[$recipeName] = 1;
        }
    }

    public static function getId(): string
    {
        return 'count_per_recipe';
    }

    public function getResult(): array
    {
        // Order alphabetically by recipe name
        ksort($this->uniqueNames);

        $result = [];
        foreach ($this->uniqueNames as $recipeName => $count) {
            $result[] = [
                'recipe' => $recipeName,
                'count' => $count,
            ];
        }
        return $result;
    }
}
