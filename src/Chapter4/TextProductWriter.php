<?php

namespace App\Chapter4;

use App\Chapter3\ShopProductWriter;

class TextProductWriter extends ShopProductWriter
{
    public function write(): void
    {
        $str = "PRODUCTS:\n";
        foreach ($this->products as $shopProduct) {
            $str .= $shopProduct->getSummaryLine() . "\n";
        }

        print $str;
    }
}
