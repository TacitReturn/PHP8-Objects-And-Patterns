<?php
namespace App\Chapter4;

class UtilityService extends Service
{
	use PriceUtilities {
//        PriceUtilities::calculateTax as private;
        PriceUtilities::calculateTax as public;
    }

    public function __construct(private float $price)
    {
        $this->price = 1;
    }

	public function getTaxRate(): float
    {
        return 20;
    }

    public function getFinalPrice(): float
    {
        return ($this->price + $this->calculateTax($this->price));
    }
}