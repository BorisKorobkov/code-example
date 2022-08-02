<?php

namespace src\counters;

use src\models\Order;

/**
 * List the recipe names (alphabetically ordered) that contain in their name one of the following words:
 *      Potato
 *      Veggie
 *      Mushroom
 * This was not required by the task condition, but only unique names are output.
 * For example:
 *      "match_by_name": [
 *          "Mediterranean Baked Veggies",
 *          "Speedy Steak Fajitas",
 *          "Tex-Mex Tilapia"
 *      ]
 */
class CounterMatchByName implements CounterInterface
{
    /**
     * @var bool[]
     * key - unique recipe name
     * value - doesn't matter. For example "true"
     */
    private array $uniqueNames = [];

    /** @var string[] */
    private array $words = [];

    public function __construct(string $wordsString, string $delimiter = ',')
    {
        $words = explode($delimiter, $wordsString);
        foreach ($words as $word) {
            $word = trim($word);
            $this->words[] = $word;
        }
    }

    public function handleOrder(Order $order): void
    {
        $recipeName = $order->recipe;
        foreach ($this->words as $word) {
            if (str_contains($recipeName, $word)) {
                $this->uniqueNames[$recipeName] = true;

                // It's OR-logic: the entry of one word is enough
                break;
            }
        }
    }

    public static function getId(): string
    {
        return 'match_by_name';
    }

    /**
     * @return string[]
     */
    public function getResult(): array
    {
        // Order alphabetically by recipe name
        ksort($this->uniqueNames);

        return array_keys($this->uniqueNames);
    }
}
