<?php

namespace App\Chapter4;

class Shipping implements IChargable
{
    public function __contruct(private float $price)
    {
    }

    public function getPrice(): int|float
    {
        return $this->price;
    }
}
