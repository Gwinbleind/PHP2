<?php


namespace app\models;



class User extends Record
{
    protected $login;
    protected $pass;
    protected $password_hash;
    protected $session_hash;

    public function __construct($id = null, $login = null, $pass = null)
    {
        parent::__construct($id);
        $this->login = $login;
        $this->pass = $pass;
    }
    public static function getTableName() :string
    {
        return 'users';
    }

    public function validation() :bool {
        return password_verify($this->pass, $this->password_hash);
    }

}