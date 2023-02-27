<?php

namespace App\Chapter4;

interface IChargable
{
    public function getPrice(): int|float; //

    public function goo(): void;
}
