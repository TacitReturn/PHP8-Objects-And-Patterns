<?php
namespace App\Chapter4;

interface IIdentityObject
{
    public function generateId(): string;
}