<?php

namespace App\Chapter4;

use App\Chapter3\ShopProductWriter;

class XmlProductWriter extends ShopProductWriter
{
    public function write(): void
    {
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument("1.0", "UTF-8");
        $writer->startElement("products");
        foreach ($this->products as $shopProduct) {
            $writer->startElement("product");
            $writer->writeAttribute("title", $shopProduct->getTitle());
            $writer->startElement("price");
            $writer->text($shopProduct->getPrice());
            $writer->endElement(); // price
            $writer->writeAttribute("link", "https://example.com");
            $writer->startElement("summary");
            $writer->text($shopProduct->getSummaryLine());
            $writer->endElement(); // summary
            $writer->endElement(); // product
        }

        $writer->endDocument(); // products
        $writer->endDocument();
        print $writer->flush();
    }
}
