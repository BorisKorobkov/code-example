<?php

namespace src\counters;

use src\models\Order;

/**
 * Count the number of unique recipe names
 * For example:
 *      "unique_recipe_count": 15
 */
class CounterUniqueRecipe implements CounterInterface
{
    /**
     * @var bool[]
     * key - unique recipe name
     * value - doesn't matter. For example "true"
     */
    private array $uniqueNames = [];

    public function handleOrder(Order $order): void
    {
        $recipeName = $order->recipe;
        $this->uniqueNames[$recipeName] = true;
    }

    public static function getId(): string
    {
        return 'unique_recipe_count';
    }

    public function getResult(): int
    {
        return count($this->uniqueNames);
    }
}
