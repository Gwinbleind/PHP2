<?php


namespace app\models;


class Category extends Record
{
    public $name;

    public static function getTableName() :string
    {
        return 'categories';
    }

}