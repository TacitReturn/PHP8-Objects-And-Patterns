<?php

namespace App\Chapter3;

abstract class ShopProductWriter
{
    protected array $products = [];

    public function addProduct(ShopProduct $shopProduct): void
    {
        $this->products[] = $shopProduct;
    }

    // public function write(): void
    // {
    //     $str = "";

    //     foreach ($this->products as $shopProduct) {
    //         $str .= "{$shopProduct->getTitle()}: ";
    //         $str .= "{$shopProduct->getProducer()} ";
    //         $str .= "{$shopProduct->getPrice()} \n";
    //     }

    //     print $str;
    // }

    abstract function write(): void;
}
