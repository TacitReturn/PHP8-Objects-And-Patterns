<?php
namespace App\Chapter4;

trait PriceUtilities
{
    private static int $taxRate = 20;

    public static function calculateTax(float $price): float
    {
        return (self::$taxRate / 100) * $price;
    }
}