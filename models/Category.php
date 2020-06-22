<?php


namespace app\models;


class Category extends Record
{
    protected $name;

    public static function getTableName() :string
    {
        return 'categories';
    }

}