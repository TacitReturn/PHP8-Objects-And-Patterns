<?php

namespace App\Chapter4\LateStaticBinding;

abstract class DomainObject
{
    private string $group;
    public function __construct()
    {
        $this->group = static::getGroup();
    }
    public static function create(): DomainObject
    {
        return new static();
    }
    public static function getGroup(): string
    {
        return "default";
    }
}

class User extends DomainObject
{
//    public static function create(): User
//    {
//        return new User();
//    }
}

class Document extends DomainObject
{
    public static function create(): Document
    {
        return new Document();
    }
    public static function getGroup(): string
    {
        return "document";
    }
}

class SpreadSheet extends Document
{

}

//$newDocument = Document::create();

print_r(User::create());
print_r(SpreadSheet::create());