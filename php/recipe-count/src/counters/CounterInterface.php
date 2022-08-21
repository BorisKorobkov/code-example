<?php

namespace src\counters;

use src\models\Order;

interface CounterInterface
{
    public function handleOrder(Order $order): void;

    public static function getId(): string;

    public function getResult(): mixed;
}
