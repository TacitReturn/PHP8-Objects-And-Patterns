<?php

namespace App\Chapter3;

use App\Chapter3\ShopProduct;

class CdProduct extends ShopProduct
{
    public function __construct(string $title, string $firstName, string $mainName, float $price, private int $playLength)
    {
        parent::__construct($title, $firstName, $mainName, $price);

        $this->playLength = $playLength;
    }

    public function getPlayLength(): int
    {
        return $this->playLength;
    }

    public function getSummaryLine(): string
    {
        $base = parent::getSummaryLine();
        $base .= "play length - $this->playLength";

        return $base;
    }
}
