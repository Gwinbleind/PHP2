<?php


namespace app\models;


class Category extends Model
{
    public $name;

    public static function getTableName() :string
    {
        return 'categories';
    }

}