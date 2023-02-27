<?php

namespace App\Chapter3;

class BookProduct extends ShopProduct
{
    public function __construct(string $title, string $firstName, string $mainName, int|float $price, private int $numPages)
    {
        parent::__construct($title, $firstName, $mainName, $price);

        $this->numPages = $numPages;
    }

    public function getNumberOfPages(): int
    {
        return $this->numPages;
    }

    public function getSummaryLine(): string
    {
        $base = parent::getSummaryLine();
        $base .= ": page count - {$this->numPages}";

        return $base;
    }

    public function getPrice(): int|float
    {
        return $this->price;
    }
}
