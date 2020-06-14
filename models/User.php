<?php


namespace app\models;


class User extends Model
{
    public $login;
    public $password_hash;
    public $session_hash;

    public function __construct($id = null, $login = null)
    {
        parent::__construct($id);
        $this->login = $login;
    }
    public function getTableName()
    {
        return 'users';
    }
}