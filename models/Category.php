<?php


namespace app\models;


class Category extends Model
{
    public $name;

    public function getTableName()
    {
        return 'categories';
    }

}