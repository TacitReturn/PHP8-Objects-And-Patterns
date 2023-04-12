<?php
namespace App\Chapter4;

trait IdentityTrait
{
    public function generateId(): string
    {
        return uniqid();
    }
}