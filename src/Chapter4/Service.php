<?php
namespace App\Chapter4;

abstract class Service
{
    public function generateId(): void
    {
        print "Product ID: ". uniqid() . PHP_EOL;
    }
}
